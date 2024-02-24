<div class="row align-items-center justify-content-start">
    @if($status_order == true)
    <div class="col-md-4 mt-3">
        <label class="form-label"> @lang('text.Sort')</label>
        <input type="number" min="0" value="{{$content->sort}}" name="sort" class="form-control" placeholder="@lang('text.Sort')">
    </div>

    <div class="col-md-4 mt-3">
        <label class="form-check-label" for="flexSwitchCheckChecked">@lang('text.Status')</label>
        <div class="form-check form-switch mt-2">
            <input class="form-check-input customSliderCheckbox" type="checkbox"
                   name="status" id="flexSwitchCheckChecked" @if($content->status == 1) checked="" value="1" @else value="0" @endif  >
        </div>
    </div>
    @endif
    @if($home_display == true)
    <div class="col-md-4 mt-3">
        <label class="form-check-label" for="flexSwitchCheckCheckedd">@lang('text.HomeDisplay')</label>
        <div class="form-check form-switch mt-2">
            <input class="form-check-input customSliderCheckbox" type="checkbox"
                   name="home_display" @if($content->home_display == 1) checked="" value="1" @else value="0" @endif id="flexSwitchCheckCheckedd">
        </div>
    </div>
    @endif

        @if($active == true)
            <div class="col-md-4 mt-3">
                <label class="form-check-label" for="flexSwitchCheckCheckedd">@lang('text.ActiveLabel')</label>
                <div class="form-check form-switch mt-2">
                    <input class="form-check-input customSliderCheckbox" type="checkbox"
                           name="active" @if($content->active == 1) checked="" value="1" @else value="0" @endif id="flexSwitchCheckCheckedd">
                </div>
            </div>
        @endif
</div>
