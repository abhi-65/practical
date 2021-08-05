<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Auth;
use Carbon\Carbon;
use DB;

class BlogController extends Controller
{
    public function index()
    {
        if(!empty(Auth::user()))
        {
            if(Auth::user()->role_id == 2)
            {
                $blog = Blog::where('user_id',Auth::user()->id)->whereDate('end_date', '>', Carbon::now())->where('status',1)->get();
            }
            else
            {
                $blog = Blog::where('status',1)->whereDate('end_date', '>', Carbon::now())->get();
            }
        }
        else
        {
            $blog = Blog::where('status',1)->whereDate('end_date', '>', Carbon::now())->get();
        }
        return view('blog.index',compact('blog'));   
    }

    public function addBlog($id=null)
    {
        $blog = null;
        if(!empty($id))
        {
            $user = Auth::user();
            if(!empty($user))
            {
                if($user->role_id == 2)
                {
                    $blog = Blog::where('user_id',$user->id)->where('id',$id)->first();
                    if(empty($blog))
                    {
                        return redirect()->back();
                    }
                }
                else
                {
                    $blog = Blog::where('id',$id)->first();
                }
            }
            else
            {

                return redirect()->back();
            }
            
        }
        return view('blog.add',compact('blog')); 
    }

    public function saveBlog(BlogRequest $blogRequest)
    {
        $id= null;
        if(isset($blogRequest['id']) && !empty($blogRequest['id']))
        {
            $id = $blogRequest['id'];
        }
        $blog = Blog::updateOrCreate([
            'id'=>$id
        ],[
            'user_id' => Auth::user()->id,
            'title' => $blogRequest['title'],
            'description' => $blogRequest['description'],
            'start_date' => date('Y-m-d',strtotime($blogRequest['start_date'])),
            'end_date' => date('Y-m-d',strtotime($blogRequest['end_date'])),
            'status' => $blogRequest['status'],
            'image' => $blogRequest['img_name']
        ]);
        if($blogRequest->hasFile('image'))
        {
            $fileName = time().'.'.$blogRequest->image->extension();  
   
            $blogRequest->image->move(public_path('blog'), $fileName);
            Blog::where('id',$blog->id)->update(['image'=>$fileName]);
        }
        return redirect()->route('index');  
    }

    public function deleteBlog($id)
    {
        $user = Auth::user();
        if(!empty($user))
        {
            if($user->role_id == 2)
            {
                $checkBlog = Blog::where('user_id',$user->id)->where('id',$id)->first();
                if(!empty($checkBlog))
                {
                    Blog::where('id',$id)->delete();
                    return redirect()->route('index');
                }
                else
                {
                    return redirect()->back();
                }
            }
            else
            {
                Blog::where('id',$id)->delete();
                return redirect()->route('index');
            }
            
        }
        else
        {
             return redirect()->back();
        }
        
        
    }
}
