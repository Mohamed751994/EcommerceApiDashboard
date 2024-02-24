@include('admin_dashboard.main.edit',
[
     'title' => __('text.'.\Request::segment(2).'-index'),
    'routeName'=>'languages',
    'inputs' =>[
        ['type' => 'text', 'required' =>true, 'name'=>'name', 'label' =>__('text.Name'), 'value' =>$content->name],
        ['type' => 'text', 'required' =>true, 'name'=>'code', 'label' =>__('text.Code').' '.' (ar, en , es, ..........)', 'value' =>$content->code],
        ['type' => 'text', 'required' =>true, 'name'=>'currency', 'label' =>__('text.Currency').' '.' (ر.س, euro , usd, ..........)', 'value' =>$content->currency],
        ['type' => 'file', 'required' =>false, 'name'=>'icon', 'label' => __('text.Icon'), 'value' =>$content->icon],
    ],
    'status_order' =>true,
    'home_display' =>false,
])
