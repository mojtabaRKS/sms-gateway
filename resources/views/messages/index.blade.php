@extends('layouts.dashboard')

@section('dashboard-content')

    <h2>List of messages</h2>
    <hr>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">phone number</th>
                    <th scope="col">text</th>
                    <th scope="col">service</th>
                    <th scope="col">status</th>
                    <th scope="col">response</th>
                    <th scope="col">operations</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $message)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $message->phone_number }}</td>
                        <td>{{ $message->message }}</td>
                        <td>{{ $message->service }}</td>
                        <td>{{ $message->status }}</td>
                        <td>{{ $message->response }}</td>
                        <td>
                            @if ($message->status === \App\Models\Message::FAILURE_STATUS)
                                <form action="{{ route('messages.resend', $message->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Resend</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    {{ $messages->links() }}
    </div>

@endsection
