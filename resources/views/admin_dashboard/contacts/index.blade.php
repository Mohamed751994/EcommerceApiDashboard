@include('admin_dashboard.main.index',
[
     'title' => __('text.'.\Request::segment(2).'-index'),
    'create' => false,
    'edit' => false,
    'show' => true,
    'delete' => true,
    'routeName'=>'contacts',
    'model'=>Contact::class,

    'thNames' =>[
        '#' => 'id',
        __('text.Name') => 'name',
        __('text.Email') => 'email',
        __('text.Phone') => 'phone',
        __('text.RegisterDate') => 'created_at',
    ]
])
