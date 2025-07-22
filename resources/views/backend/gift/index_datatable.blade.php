@extends('backend.layouts.app')

@section('title')
{{ __($module_action) }} {{ __($module_title) }}
@endsection

@push('after-styles')
@endpush

@section('content')
<div class="card">
    <div class="card-body">
        <h3 class="mb-4">{{ __('messages.gift_cards_list') }}</h3>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('messages.gift_card_name') }}</th>
                    <th>{{ __('messages.gift_card_code') }}</th>
                    <th>{{ __('messages.gift_card_amount') }}</th>
                    <th>{{ __('messages.gift_card_status') }}</th>
                    <th>{{ __('messages.gift_card_created_at') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($gifts as $gift)
                    <tr>
                        <td>{{ $gift->id }}</td>
                        <td>{{ $gift->name ?? '-' }}</td>
                        <td>{{ $gift->code ?? '-' }}</td>
                        <td>{{ $gift->amount ?? '-' }}</td>
                        <td>
                            @if(isset($gift->status))
                                {{ $gift->status ? __('messages.gift_card_active') : __('messages.gift_card_inactive') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $gift->created_at ? $gift->created_at->format('Y-m-d') : '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">{{ __('messages.gift_card_none') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
