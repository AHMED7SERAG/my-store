@extends('layouts.admin')

@section('content')

<div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.languages')}}"> الاقسام  </a>
                                </li>
                                <li class="breadcrumb-item active">  تعديل  قسم 
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2 > تعديل قسم  - {{ $main_category->name}} </h2>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{route('admin.maincategories.update',$main_category->id)}}" method="POST"
                                              enctype="multipart/form-data">
                                              @csrf
                                              <div class="form-group">
                                                <div class="text-center">
                                                    <img
                                                        src="{{ asset('assets/'.$main_category->photo)  }}"
                                                        class="rounded-circle  height-150" alt="صورة القسم  ">
                                                </div>
                                            </div>
                                              <div class="form-group">
                                                <label> صوره القسم </label>
                                                <label id="projectinput7" class="file center-block">
                                                    <input type="file" id="file" value="" name="photo">
                                                    <span class="file-custom"></span>
                                                </label>
                                                @error("photo")
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                             <input  type="hidden" name="id" value="{{ $main_category->id }}">
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> بيانات القسم  </h4>
                                                    <div class="col-md-6 hidden">
                                                        <div class="form-group">
                                                            <label for="projectinput1">  اختصار اللغة - {{ __(
                                                                'messages.'.$main_category->translation_lang) }}</label>
                                                            <input type="text"   
                                                                class="form-control"
                                                                placeholder="ادخل اختصار اللغة"
                                                                name="category[0][translation_lang]"
                                                                value="{{ $main_category->translation_lang }}">
                                                                @error("category.0.translation_lang")
                                                                <span class="text-danger">هذا الحقل مطلوب </span>
                                                                @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="projectinput1">  اسم القسم - {{ __(
                                                                'messages.'.$main_category->translation_lang) }}  </label>
                                                                <input type="text"value="{{ $main_category->name }}" 
                                                                    class="form-control"
                                                                    placeholder="ادخل اسم القسم  "
                                                                    
                                                                    name="category[0][name]">
                                                                    @error("category.0.name")
                                                                    <span class="text-danger">هذا الحقل مطلوب </span>
                                                                    @enderror
                                                            </div>
                                                        
                                                        </div>
                                                    </div>
    
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group mt-1">
                                                                <input type="checkbox" value="1"
                                                                 name="category[0][active]"
                                                                    id="switcheryColor4"
                                                                    class="switchery" data-color="success"
                                                                   @if ($main_category->active == 1)
                                                                   checked   
                                                                   @endif />
                                                                <label for="switcheryColor4"
                                                                    class="card-title ml-1">  الحالة -{{ __(
                                                                        'messages.'.$main_category->translation_lang) }} </label>
                                                            </div>
                                                            @error("category.0.active")
                                                            <span class="text-danger">هذا الحقل مطلوب </span>
                                                                @enderror
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> تحديث
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-xl-12 col-lg-12">
                                        <div class="card">
                                          <div class="card-header">
                                            <h4 class="card-title">Tabs with dropdown</h4>
                                          </div>
                                          <div class="card-content">
                                            <div class="card-body">
                                              <ul class="nav nav-tabs nav-linetriangle">
                                                  @isset($main_category->categories)
                                                      @foreach ($main_category->categories as  $index => $translations_category )
                                                      <li class="nav-item  ">
                                                        <a class="nav-link @if ($index == 0) active  @endif " id="home-tab" data-toggle="tab" href="#home-tab{{$index}}" aria-controls="home"
                                                        aria-expanded="true">{{ $translations_category-> translation_lang }}</a>
                                                      </li>
                                                      @endforeach
                                                  @endisset
                                               
                                              </ul>
                                              <div class="tab-content px-1 pt-1">
                                                @isset($main_category->categories)
                                                @foreach ($main_category->categories as  $index => $translations_category )
                                                <div role="tabpanel" class="tab-pane  @if ($index == 0) active  @endif"id="home-tab{{$index}}" aria-labelledby="home-tab" aria-expanded=" @if ($index == 0) true @endif">
                                                    <form class="form" action="{{route('admin.maincategories.update',$translations_category->id)}}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                       <input  type="hidden" name="id" value="{{ $translations_category->id }}">
                                                      <div class="form-body">
                                                          <h4 class="form-section"><i class="ft-home"></i> بيانات القسم  </h4>
                                                              <div class="col-md-6 hidden">
                                                                  <div class="form-group">
                                                                      <label for="projectinput1">  اختصار اللغة - {{ __(
                                                                          'messages.'.$translations_category->translation_lang) }}</label>
                                                                      <input type="text"   
                                                                          class="form-control"
                                                                          placeholder="ادخل اختصار اللغة"
                                                                          name="category[0][translation_lang]"
                                                                          value="{{ $translations_category->translation_lang }}">
                                                                          @error("category.0.translation_lang")
                                                                          <span class="text-danger">هذا الحقل مطلوب </span>
                                                                          @enderror
                                                                  </div>
                                                              </div>
                                                              <div class="row">
                                                                  <div class="col-md-12">
                                                                      <div class="form-group">
                                                                          <label for="projectinput1">  اسم القسم - {{ __(
                                                                          'messages.'.$translations_category->translation_lang) }}  </label>
                                                                          <input type="text"value="{{ $translations_category->name }}" 
                                                                              class="form-control"
                                                                              placeholder="ادخل اسم القسم  "
                                                                              
                                                                              name="category[0][name]">
                                                                              @error("category.0.name")
                                                                              <span class="text-danger">هذا الحقل مطلوب </span>
                                                                              @enderror
                                                                      </div>
                                                                  
                                                                  </div>
                                                              </div>
              
                                                              <div class="row">
                                                                  <div class="col-md-6">
                                                                      <div class="form-group mt-1">
                                                                          <input type="checkbox" value="1"
                                                                           name="category[0][active]"
                                                                              id="switcheryColor4"
                                                                              class="switchery" data-color="success"
                                                                             @if ($translations_category->active == 1)
                                                                             checked   
                                                                             @endif />
                                                                          <label for="switcheryColor4"
                                                                              class="card-title ml-1">  الحالة -{{ __(
                                                                                  'messages.'.$translations_category->translation_lang) }} </label>
                                                                      </div>
                                                                      @error("category.0.active")
                                                                      <span class="text-danger">هذا الحقل مطلوب </span>
                                                                          @enderror
                                                                  </div>
                                                              </div>
                                                      </div>
                                                      <div class="form-actions">
                                                          <button type="button" class="btn btn-warning mr-1"
                                                                  onclick="history.back();">
                                                              <i class="ft-x"></i> تراجع
                                                          </button>
                                                          <button type="submit" class="btn btn-primary">
                                                              <i class="la la-check-square-o"></i> تحديث
                                                          </button>
                                                      </div>
                                                  </form>
                                                </div>
                                                @endforeach
                                                @endisset
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

@endsection