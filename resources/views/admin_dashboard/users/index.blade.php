
@include('admin_dashboard.main.index',
[
    'title' => __('text.'.\Request::segment(2).'-index'),
    'create' => true,
    'edit' => true,
    'show' => false,
    'delete' => true,
    'routeName'=>'users',
    'model'=>User::class,
    'thNames' =>[
        '#' => 'id',
         __('text.Name') => 'name',
        __('text.Email') => 'email',
    ]
])
