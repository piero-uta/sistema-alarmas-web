@extends('layouts.app')
@section('title', 'Dashboard monitoreo')

@push('head-scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJNN-iTg6exmzgXLjB_4KNGY_869oNBGM&v=beta&libraries=marker&callback=initMap"></script>
@endpush

@section('content')

<h2>Dashboard de monitoreo</h2>

<div id="map" style="height: 400px; width: 100%; z-index: 0; margin: 3rem 0"></div>

@endsection

@section('scripts')

<script type="text/javascript" src="{{ asset('js/monitoreo/mapa.js') }}"></script>

@endsection
