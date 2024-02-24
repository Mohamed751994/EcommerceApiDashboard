<div class="row align-items-center justify-content-between">
    @if($status_order == true)
    <div class="col-md-4 mt-3">
        <label class="form-label">@lang('text.Sort')</label>
        <input type="number" min="0" value="0" name="sort" class="form-control" placeholder="@lang('text.Sort')">
    </div>
    <div class="col-md-4 mt-3">
        <label class="form-check-label" for="flexSwitchCheckChecked">@lang('text.Status')</label>
        <div class="form-check form-switch mt-2">
            <input class="form-check-input customSliderCheckbox" type="checkbox"
                   name="status" value="1" id="flexSwitchCheckChecked" checked="">
        </div>
    </div>
    @endif
    @if($home_display == true)
    <div class="col-md-4 mt-3">
        <label class="form-check-label" for="flexSwitchCheckCheckedd">@lang('text.HomeDisplay')</label>
        <div class="form-check form-switch mt-2">
            <input class="form-check-input customSliderCheckbox" type="checkbox"
                   name="home_display" value="1" id="flexSwitchCheckCheckedd">
        </div>
    </div>
    @endif

</div>
