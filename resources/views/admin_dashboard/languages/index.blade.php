@include('admin_dashboard.main.index',
[
    'title' => __('text.'.\Request::segment(2).'-index'),
    'create' => true,
    'edit' => true,
    'show' => false,
    'delete' => true,
    'routeName'=>'languages',
    'model'=>Language::class,
    'thNames' =>[
        '#' => 'id',
         __('text.Icon') => 'icon',
         __('text.Name') => 'name',
         __('text.Code') => 'code',
         __('text.Currency') => 'currency',
       __('text.Status') => 'status',
         __('text.Sort') => 'sort'
    ]
])
