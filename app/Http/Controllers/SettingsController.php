<?php
namespace App\Http\Controllers;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\DocBlock\Tags\See;

class SettingsController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function index() {
        $data['asideMenu']    = 'settings';
        $data['asideSubmenu'] = '';
        
        $data['privilege'] = Auth::user()->privilege;

        $settings = Settings::all();
        if (!empty($settings)) {
            foreach ($settings as $key => $value) {
                if (!empty($value)) {
                    $data[$value->meta_key] = $value->meta_value;
                }
            }
        }

        return view('settings.index', $data);
    }

    public function store(Request $request) {
        if (!empty($request->setting)) {
            foreach ($request->setting as $key => $value) {
                if (!empty($value)) {

                    if (Settings::where('meta_key', $key)->first()) {
                        $data = Settings::where('meta_key', $key)->first();
                    } else {
                        $data = new Settings;
                    }

                    $data->meta_key   = $key;
                    $data->meta_value = $value;

                    $data->save();
                }
            }
        }


        if (!empty($request->file('logo'))) {
            if (Settings::where('meta_key', 'logo')->first()) {
                $data = Settings::where('meta_key', 'logo')->first();
            } else {
                $data = new Settings;
            }

            if (file_exists($data->meta_value)) {
                unlink($data->meta_value);
            }

            $data->meta_key   = 'logo';
            $data->meta_value = uploadFile($request->file('logo'), 'public/uploads/logo');
            $data->save();
        }

        if (!empty($request->file('favicon'))) {
            if (Settings::where('meta_key', 'favicon')->first()) {
                $data = Settings::where('meta_key', 'favicon')->first();
            } else {
                $data = new Settings;
            }

            if (file_exists($data->meta_value)) {
                unlink($data->meta_value);
            }

            $data->meta_key   = 'favicon';
            $data->meta_value = uploadFile($request->file('favicon'), 'public/uploads/logo');

            $data->save();
        }
        return redirect()->route('admin.settings')->with(['success' => 'Save successful.']);
    }
}
