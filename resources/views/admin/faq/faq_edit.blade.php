@extends('layouts.dash')
@section('content')
    <div class="row">
        <div class="col-lg-7 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Add FAQ</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('faq.update', $faq->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <input type="text" name="question" placeholder="Question ?" class="form-control" style="padding: 12px; border-radius: 4px;" value="{{ $faq->question }}">
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="answer" id="" cols="30" rows="10" placeholder="Answer :" style="padding: 12px; border-radius: 4px;">{{ $faq->answer }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Update FAQ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection