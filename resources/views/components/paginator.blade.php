@props(['type'])

<style>
    .no {
        white-space: nowrap;
    }
</style>

<div class="d-flex justify-content-between mt-3 w-100">
    <div class="no p-2"> Total - {!! $type->total() !!} </div>

    <div>
        {!! $type->withQueryString()->links() !!}
    </div>
</div>