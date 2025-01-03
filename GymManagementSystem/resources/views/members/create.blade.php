@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>{{ isset($member) ? 'Edit Member' : 'Add Member' }}</h1>

        <form action="{{ isset($member) ? route('members.update', $member->id) : route('members.store') }}" method="POST">
            @csrf
            @if(isset($member))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $member->name ?? old('name') }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $member->email ?? old('email') }}">
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ $member->phone ?? old('phone') }}">
            </div>

            <div class="mb-3">
                <label for="membership_type" class="form-label">Membership Type</label>
                <select
                    id="membership_type"
                    name="membership_type"
                    class="form-control"
                    required>
                    <option value="Basic" {{ $member->membership_type ?? old('membership_type') == 'Basic' ? 'selected' : '' }}>Basic</option>
                    <option value="Premium" {{ $member->membership_type ?? old('membership_type') == 'Premium' ? 'selected' : '' }}>Premium</option>
                    <option value="VIP" {{ $member->membership_type ?? old('membership_type') == 'VIP' ? 'selected' : '' }}>VIP</option>

                </select>
            </div>



            <div class="mb-3">
                <label for="membership_start_date" class="form-label">Membership Start</label>
                <input type="date" name="membership_start_date" id="membership_start_date" class="form-control" value="{{ $member->membership_start_date ?? old('membership_start_date') }}">
            </div>


            <div class="mb-3">
                <label for="membership_end_date" class="form-label">Membership End</label>
                <input type="date" name="membership_end_date" id="membership_end_date" class="form-control" value="{{ $member->membership_end_date ?? old('membership_end_date') }}">
            </div>



            <button type="submit" class="btn btn-success">{{ isset($member) ? 'Update' : 'Add' }}</button>
        </form>
    </div>
@endsection
