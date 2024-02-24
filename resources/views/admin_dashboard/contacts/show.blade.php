@include('admin_dashboard.main.show',
[
     'title' => __('text.'.\Request::segment(2).'-index'),
    'routeName'=>'contacts',
    'model'=>Contact::class,
    'data' => [
        ['value' => $content->created_at, 'type'=>'text', 'index' =>1, 'name_ar' => __('text.RegisterDate')],
        ['value' => $content->name, 'type'=>'text', 'index' =>1, 'name_ar' => __('text.Name')],
        ['value' => $content->email, 'type'=>'text', 'index' =>1, 'name_ar' => __('text.Email')],
        ['value' => $content->phone, 'type'=>'text', 'index' =>1, 'name_ar' => __('text.Phone')],
        ['value' => $content->message, 'type'=>'text', 'index' =>1, 'name_ar' => __('text.Message')],
    ]
])
