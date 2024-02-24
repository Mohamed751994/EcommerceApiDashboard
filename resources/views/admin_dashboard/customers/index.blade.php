@include('admin_dashboard.main.index',
[
    'title' => __('text.'.\Request::segment(2).'-index'),
    'create' => true,
    'edit' => true,
    'show' => false,
    'delete' => true,
    'routeName'=>'customers',
    'model'=>User::class,
    'thNames' =>[
        '#' => 'id',
         __('text.Name') => 'name',
         __('text.Email') => 'email',
         __('text.RegisterDate') => 'created_at',
         __('text.Verified') => 'email_verified_at',
         __('text.OrdersCount') => 'orders_count',
    ]
])
