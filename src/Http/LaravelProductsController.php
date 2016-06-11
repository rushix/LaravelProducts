<?php

namespace Rushix\LaravelProducts\Http;

use View;
use Input;
use Html;
use Form;
use Validator;
use Session;
use Redirect;

use Illuminate\Http\Request;

use App\Http\Requests;

use Rushix\LaravelProducts\Models\LaravelProduct as LaravelProduct;

class LaravelProductsController extends \App\Http\Controllers\Controller
{
    const ROLE = 'manager';
    const UNIQUE_IDENTIFIER = 'rushi-products';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all the products
        $products = LaravelProduct::all();

        // load the view and pass the products
        return View::make(self::UNIQUE_IDENTIFIER . '::index')
            ->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // load the create form (app/views/products/create.blade.php)
        return View::make(self::UNIQUE_IDENTIFIER . '::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'name'  => 'required|min:10',
            'art'   => 'required|unique:rushix_laravelproducts_products|regex:/(^[A-Za-z0-9]+$)+/'
        );
        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('products/create')
                ->withErrors($validator)
                ->withInput($request->except(['password']));
        } else {
            // store
            $product = new LaravelProduct;
            $product->name      = $request->input('name');
            $product->art       = $request->input('art');
            $product->save();

            // redirect
            Session::flash('message', 'Successfully created product!');
            return Redirect::to('products');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get the product
        $product = LaravelProduct::find($id);

        // show the view and pass the product to it
        return View::make(self::UNIQUE_IDENTIFIER . '::show')
            ->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = self::ROLE;
        // Uncomment the next line if the current_user_type is bound
        //$role = app('current_user_type') ? app('current_user_type') : 'manager';

        // get the product
        $product = LaravelProduct::find($id);

        // show the edit form and pass the product
        return View::make(self::UNIQUE_IDENTIFIER . '::edit')
            ->with('product', $product)
            ->with('role', $role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = self::ROLE;
        // Uncomment the next line if the current_user_type is bound
        //$role = app('current_user_type') ? app('current_user_type') : 'manager';

        $oldProduct = LaravelProduct::find($id);

        $rules = array(
            'name'  => 'required|min:10',
            'art'   => 'required|unique:rushix_laravelproducts_products,art,' . $oldProduct->id . '|regex:/(^[A-Za-z0-9]+$)+/|checkrole:' . $role . ',' . $oldProduct->art  
        );

        $messages = array(
            'checkrole' => 'Permission denied: managers may not change Article.',
        );

        $validator = Validator::make($request->all(), $rules, $messages);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('products/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput($request->except(['password']));
        } else {
            // store
            $product = LaravelProduct::find($id);
            $product->name  = $request->input('name');
            $product->art   = $request->input('art');
            $product->save();

            // redirect
            Session::flash('message', 'Successfully updated product!');
            return Redirect::to('products');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $product = LaravelProduct::find($id);
        $product->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the product!');
        return Redirect::to('products');
    }
}
