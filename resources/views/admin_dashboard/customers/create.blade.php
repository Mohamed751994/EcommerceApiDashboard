@include('admin_dashboard.main.create',
[
     'title' => __('text.'.\Request::segment(2).'-index'),
    'routeName'=>'customers',
    'inputs' =>[
        ['type' => 'text', 'required' =>true, 'name'=>'name', 'label' =>__('text.Name')],
        ['type' => 'email', 'required' =>true, 'name'=>'email', 'label' =>__('text.Email')],
        ['type' => 'number', 'required' =>true, 'name'=>'phone', 'label' =>__('text.Phone')],
        ['type' => 'password', 'required' =>true, 'name'=>'password', 'label' =>__('text.Password')],
        ['type' => 'password', 'required' =>true, 'name'=>'password_confirmation', 'label' =>__('text.confirmPassword')],
    ],
    'status_order' =>false,
    'home_display' =>false,
])
