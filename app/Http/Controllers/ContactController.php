<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        // Get contacts
        $contacts = Contact::paginate(10);

        // Return collection of contacts as a resource
        return ContactResource::collection($contacts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return ContactResource|JsonResponse|object
     */
    public function store(Request $request)
    {
        // Create new contact
        $contact = Contact::create($request->all());

        // Return contact as a resource with 201 response code
        return (new ContactResource($contact))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return ContactResource
     */
    public function show($id)
    {
        // Get contact
        $contact = Contact::findOrFail($id);

        // Return contact as a resource
        return new ContactResource($contact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return ContactResource
     */
    public function update(Request $request, $id)
    {
        // Check if contact exists
        $contact = Contact::findOrFail($id);

        // Update contact
        $contact->update($request->all());

        // Return contact as a resource
        return new ContactResource($contact);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        // Check if contact exists
        $contact = Contact::findOrFail($id);

        // Delete contact and return 204 response code
        if ($contact->delete())
            return response()->json(null, 204);
    }
}
