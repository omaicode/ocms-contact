<?php

namespace Modules\Contact\Http\Controllers\Guest;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Contact\Entities\Contact;

class ContactController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|max:30',
            'email'   => 'required|email',
            'subject' => 'required|min:10|max:255',
            'content' => 'required|max:500'
        ]);

        Contact::create($request->only(['name', 'email', 'subject', 'content']));

        return redirect()->back()->with('success', 'success');
    }
}
