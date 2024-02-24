@include('admin_dashboard.main.edit',
[
     'title' => __('text.'.\Request::segment(2).'-index'),
    'routeName'=>'customers',
    'inputs' =>[
        ['type' => 'text', 'required' =>true, 'name'=>'name', 'label' =>__('text.Name'), 'value'=>$content->name],
        ['type' => 'email', 'required' =>true, 'name'=>'email', 'label' =>__('text.Email'), 'value'=>$content->email],
        ['type' => 'number', 'required' =>true, 'name'=>'phone', 'label' =>__('text.Phone'), 'value'=>$content->phone],
    ],
    'active' =>true,
    'status_order' =>false,
    'home_display' =>false,
])
