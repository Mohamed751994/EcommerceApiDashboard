@push('scripts')
    <script src="{{asset('admin_dashboard/assets/plugins/notifications/js/lobibox.min.js')}}"></script>
    <script src="{{asset('admin_dashboard/assets/plugins/notifications/js/notifications.min.js')}}"></script>
    <script src="{{asset('admin_dashboard/assets/plugins/notifications/js/notification-custom-script.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        //Change Status Quickly
        function quickChange(element , item, id, col)
        {
            var val = $(element).val();
            $.ajax({
                url: "{{route('admin.quickChange')}}",
                type: 'post',
                data: {_token: '{{csrf_token()}}', id:id, item:item, val:val, col:col},
                success: function(response) {
                    if(response.success)
                    {
                        if(val === '1')
                        {
                            $(element).attr('value', '0');
                        }
                        else
                        {
                            $(element).attr('value', '1');
                        }
                    }
                },
                error: function (reject) {

                },
            });
        }


        //checkAll
        $(document).on('click', '#checkAll', function(){
            if (this.checked) {
                $(".checkAll").prop("checked", true);
            } else {
                $(".checkAll").prop("checked", false);
            }
        });
        $(document).on('click', '.checkAll', function(){
            var numberOfCheckboxes = $('.checkAll').length;
            var numberOfCheckboxesChecked = $('.checkAll:checked').length;
            if(numberOfCheckboxes === numberOfCheckboxesChecked) {
                $("#checkAll").prop("checked", true);
            } else {
                $("#checkAll").prop("checked", false);
            }
        });


        //deleteSelected
        $(document).on('click','#deleteSelected', function(){
            var numberOfCheckboxesChecked = $('.checkAll:checked').length;
            var valuesOfCheckboxesChecked = $('.checkAll:checked');
            if(numberOfCheckboxesChecked > 0)
            {

                Swal.fire({
                    title: "@lang('text.AreYouSure')",
                    text: "@lang('text.AreYouSure')",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "@lang('text.Yes')",
                    cancelButtonText: "@lang('text.No')"
                }).then((result) => {
                    if (result.isConfirmed) {


                        var Ids = [];
                        $(valuesOfCheckboxesChecked).each(function(key, val){
                            Ids.push(val.value);
                        })
                        $.ajax({
                            url: "{{route('admin.deleteSelectedItems')}}",
                            type: 'post',
                            data: {_token: '{{csrf_token()}}', ids:Ids,model:'{{$model}}' },
                            success: function(response) {
                                if(response.success)
                                {
                                    location.reload();
                                }
                            },
                            error: function (reject) {

                            },
                        });



                    }
                });

            }
            else
            {
                Lobibox.notify('error', {
                    pauseDelayOnHover: true,
                    icon: 'bx bx-info-circle',
                    rounded: true,
                    continueDelayOnInactiveTab: false,
                    position: 'top left',
                    size: 'mini',
                    msg: '@lang('text.MustSelectedFirstly')'
                });
            }
        });


    </script>
@endpush
