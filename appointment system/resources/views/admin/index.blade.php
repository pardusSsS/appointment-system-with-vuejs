@extends('layouts.app')
@section('content')

    <admin-front></admin-front>
@endsection

@section('script')

    <script>
        $(document).ready( function () {
            $('.adminTable').DataTable();
        } );
    </script>
@endsection
