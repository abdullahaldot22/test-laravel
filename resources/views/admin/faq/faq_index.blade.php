@extends('layouts.dash')

@section('content')
    <div class="row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header">
                    <h3>FAQ's</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <table class="table primary-table-bordered">
                            <thead class="thead-primary">
                                <tr>
                                    <th>Question</th>
                                    <th>Answer</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($faqs as $faq)
                                    <tr>
                                        <td>{{ $faq->question }}</td>
                                        <td>{{ $faq->answer }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-success light sharp" data-toggle="dropdown">
                                                    <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('faq.edit', $faq->id) }}">Edit</a>
                                                    <form action="{{ route('faq.destroy', $faq->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h3>Add FAQ</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('faq.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="question" placeholder="Question ?" class="form-control" style="padding: 12px; border-radius: 4px;">
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="answer" id="" cols="30" rows="10" placeholder="Answer :" style="padding: 12px; border-radius: 4px;"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Submit FAQ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection