<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {

  }

  /**
   * Show the application landing page for user
   *
   * @return \Illuminate\Http\Response
   */
  public function getIndex()
  {
      return view('contactus');
  }
}