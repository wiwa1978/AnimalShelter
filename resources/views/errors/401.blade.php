@extends('errors::layout')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', 'Er ging iets mis. Je probeert een pagina te benaderen waarvoor je niet de juiste rechten hebt.')
