{!! Former::text('manufacturer') !!}
{!! Former::text('name') !!}
{!! Former::number('rrp', 'RRP')->prepend('$')->step(0.1) !!}
{!! Former::submit('save')->addClass('btn-primary pull-right') !!}