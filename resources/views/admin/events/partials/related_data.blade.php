<div class="card"> 
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="#event_brands" role="tab" data-toggle="tab">
                {{ trans('cruds.brand.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#events_visitors" role="tab" data-toggle="tab">
                {{ trans('cruds.visitor.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" role="tabpanel" id="event_brands" style="padding:25px">
            @includeIf('admin.events.relationships.eventBrands', ['brands' => $event->eventBrands])
        </div>
        <div class="tab-pane" role="tabpanel" id="events_visitors" style="padding:25px">
            @includeIf('admin.events.relationships.eventsVisitors', ['visitors' => $event->eventsVisitors])
        </div>
    </div>
</div>
