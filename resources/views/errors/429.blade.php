@extends('errors::layout')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', 'Er kwamen te veel verzoeken binnen. Probeer het later opnieuw.')
