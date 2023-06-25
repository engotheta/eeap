<?php namespace App\Http\Controllers\cms;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\SpecialPage;
use Response;
use Validator;
use Redirect;

class MenusController extends BaseController {

    public function index()
    {
        $menus = Menu::get();
        $specialPage = SpecialPage::pluck('title_en','slug');
        return view('cms.menus.index', compact('menus','specialPage'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Menu::$rules);

        $menu = Menu::create($request->all());

        if($menu){
            return redirect('cms/menu')->with('status', 'success');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::find($id);

        return view("cms.menus.edit", compact('menu'));
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
        $request->validate(Menu::$rules);

        $menu = Menu::find($id);

        $menu->update($request->all());


        return redirect('cms/menu')->with('status', 'success');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {

        $menu = Menu::find($id);

        //delete the menu items attached to it first...
        $menu->menu_items()->delete();
        
        $menu->delete();

        return redirect('cms/menu')->with('status', 'success');
    }


}
