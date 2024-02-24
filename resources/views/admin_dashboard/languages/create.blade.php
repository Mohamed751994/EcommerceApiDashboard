@include('admin_dashboard.main.create',
[
     'title' => __('text.'.\Request::segment(2).'-index'),
    'routeName'=>'languages',
    'inputs' =>[
        ['type' => 'text', 'required' =>true, 'name'=>'name', 'label' =>__('text.Name')],
        ['type' => 'text', 'required' =>true, 'name'=>'code', 'label' =>__('text.Code').' '.' (ar, en , es, ..........)'],
        ['type' => 'text', 'required' =>true, 'name'=>'currency', 'label' =>__('text.Currency').' '.' (ر.س, euro , usd, ..........)'],
        ['type' => 'file', 'required' =>false, 'name'=>'icon', 'label' => __('text.Icon')],
    ],
    'status_order' =>true,
    'home_display' =>false,
])
