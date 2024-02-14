<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('articles.index', [
            'articles' => Article::with('user')->latest()->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {


        $validated = $request->validate(Article::$rules);
        $article = $request->user()->articles()->create($validated);

        // Check if a file was uploaded under the 'cover' input field
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $path = $file->store('covers');
            // Save the relative path in the 'cover' attribute
            $article->cover = $path;
            $article->save();
        }
        return redirect(route('articles.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article): View
    {
        $this->authorize('update', $article);
        return view('articles.edit', [
            'article' => $article,
        ]);
    }
    /**
     * Update the specified resource in storage.
     */

//    public function update(Request $request, Article $article): RedirectResponse
//    {
//        //
//        $this->authorize('update', $article);
//        $validated = $request->validate(Article::$rules);
//        $article->update($validated);
//
//        // Sending a success flash message
//        Session::flash('success', 'article successfully edited!');
//        return redirect(route('articles.index'));
//    }

    public function update(Request $request, Article $article): RedirectResponse
    {

        // Validate the request data
        $validated = $request->validate(Article::$rules);

        // Update article with validated data except the cover image
        $article->update(Arr::except($validated, ['cover']));

        // Check if a new file was uploaded under the 'cover' input field
        if ($request->hasFile('cover')) {


            // Optional: Delete the old cover image if exists
            if ($article->cover && Storage::exists($article->cover)) {

                Storage::delete($article->cover);
            }

            // Upload the new cover image and update the article's cover attribute
            $file = $request->file('cover');
            $path = $file->store('covers');
            $article->cover = $path;
            $article->save();
        }

        return redirect(route('articles.index'))->with('success', 'Article updated successfully.');
    }

    public function publish(Article $article): RedirectResponse
    {
        //
        $this->authorize('update', $article);
        $article->published= !$article->published;
        $article->update(['published']);
        // Sending a success flash message
        $article->published?
        Session::flash('success', 'article successfully published!'):
        Session::flash('success', 'article successfully unpublished!');
        return redirect(route('articles.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Article $article)
    {
        $this->authorize('delete', $article);
        $article->delete();
        Session::flash('success', 'Your article has been successfully deleted.');
        return redirect(route('articles.index'));
    }


    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('public/files'); // Stores in 'storage/app/public/files'

            // Generate a URL to the stored file
            $url = Storage::url($path);

            // Assuming you have a related model called `Document` for storing file links
            $document = new Document();
            $document->file_url = $url;
            $document->save();

            return back()->with('success', 'File has been uploaded successfully');
        }

        return back()->with('error', 'No file uploaded');
    }
}
