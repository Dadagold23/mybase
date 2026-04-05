@extends('layouts.app')

@section('content')
    <div class="py-5">
        <h1>Contact Us</h1>
        <p class="text-muted">Send your enquiry and we will respond as soon as possible.</p>
        <form method="post" action="{{ route('contact.submit') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                @error('name')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                @error('email')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Message</label>
                <textarea name="message" class="form-control" rows="5">{{ old('message') }}</textarea>
                @error('message')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn btn-primary">Send message</button>
        </form>
    </div>
@endsection
