@extends('admin.layouts.app')

@section('content')
<div class="mb-4">
    <h2>Global Settings</h2>
    <p class="text-muted">Manage site configuration, contact details, and SEO metadata.</p>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ route('admin.settings.save') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <ul class="nav nav-pills mb-4 border-bottom pb-2" id="settingsTab" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" id="general-tab" data-bs-toggle="pill" data-bs-target="#general" type="button">General & Branding</button>
                </li>
                <li class="nav-item ms-2">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="pill" data-bs-target="#contact" type="button">Contact & Location</button>
                </li>
                <li class="nav-item ms-2">
                    <button class="nav-link" id="social-tab" data-bs-toggle="pill" data-bs-target="#social" type="button">Social Media</button>
                </li>
                <li class="nav-item ms-2">
                    <button class="nav-link" id="seo-tab" data-bs-toggle="pill" data-bs-target="#seo" type="button">SEO Metadata</button>
                </li>
            </ul>

            <div class="tab-content" id="settingsTabContent">
                <!-- General Tab -->
                <div class="tab-pane fade show active" id="general">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Site Name</label>
                            <input type="text" name="site_name" class="form-control" value="{{ old('site_name', $setting->site_name) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Site Tagline</label>
                            <input type="text" name="site_tagline" class="form-control" value="{{ old('site_tagline', $setting->site_tagline) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Site Logo</label>
                            <input type="file" name="site_logo" class="form-control">
                            @if($setting->site_logo)
                                <img src="{{ asset('storage/'.$setting->site_logo) }}" class="mt-2 border rounded p-1" style="height: 50px;">
                            @endif
                        </div>
                         <div class="col-md-6">
                            <label class="form-label fw-bold">Dark Logo</label>
                            <input type="file" name="site_signature" class="form-control">
                            @if($setting->site_signature)
                                <div class="mt-2 text-center p-2 border rounded bg-light" style="width: 200px;">
                                    <img src="{{ asset('storage/'.$setting->site_signature) }}" style="max-height: 60px;">
                                    <small class="d-block text-muted mt-1">Dark Logo</small>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Favicon</label>
                            <input type="file" name="site_favicon" class="form-control">
                            @if($setting->site_favicon)
                                <img src="{{ asset('storage/'.$setting->site_favicon) }}" class="mt-2 border rounded p-1" style="height: 32px;">
                            @endif
                        </div>
                       
                        <div class="col-12">
                            <label class="form-label fw-bold">Copyright Text</label>
                            <input type="text" name="copyright_text" class="form-control" value="{{ old('copyright_text', $setting->copyright_text) }}">
                        </div>
                    </div>
                </div>

                <!-- Contact Tab -->
                <div class="tab-pane fade" id="contact">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Contact Email</label>
                            <input type="email" name="contact_email" class="form-control" value="{{ old('contact_email', $setting->contact_email) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Contact Phone</label>
                            <input type="text" name="contact_phone" class="form-control" value="{{ old('contact_phone', $setting->contact_phone) }}">
                        </div>
                         <div class="col-md-6">
                            <label class="form-label fw-bold">Contact Phone Two</label>
                            <input type="text" name="phone_two" class="form-control" value="{{ old('phone_two', $setting->phone_two) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">WhatsApp Number</label>
                            <input type="text" name="whatsapp_number" class="form-control" value="{{ old('whatsapp_number', $setting->whatsapp_number) }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Physical Address</label>
                            <textarea name="address" class="form-control" rows="2">{{ old('address', $setting->address) }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Google Map Embed/Link</label>
                            <textarea name="google_map_link" class="form-control" rows="2">{{ old('google_map_link', $setting->google_map_link) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Social Tab -->
                <div class="tab-pane fade" id="social">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold"><i class="bi bi-facebook me-2 text-primary"></i>Facebook URL</label>
                            <input type="url" name="facebook_url" class="form-control" value="{{ old('facebook_url', $setting->facebook_url) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold"><i class="bi bi-instagram me-2 text-danger"></i>Instagram URL</label>
                            <input type="url" name="instagram_url" class="form-control" value="{{ old('instagram_url', $setting->instagram_url) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold"><i class="bi bi-twitter-x me-2"></i>Twitter/X URL</label>
                            <input type="url" name="twitter_url" class="form-control" value="{{ old('twitter_url', $setting->twitter_url) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold"><i class="bi bi-youtube me-2 text-danger"></i>YouTube URL</label>
                            <input type="url" name="youtube_url" class="form-control" value="{{ old('youtube_url', $setting->youtube_url) }}">
                        </div>
                    </div>
                </div>

                <!-- SEO Tab -->
                <div class="tab-pane fade" id="seo">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-bold">SEO Meta Title</label>
                            <input type="text" name="seo_meta_title" class="form-control" value="{{ old('seo_meta_title', $setting->seo_meta_title) }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">SEO Meta Description</label>
                            <textarea name="seo_meta_description" class="form-control" rows="3">{{ old('seo_meta_description', $setting->seo_meta_description) }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">SEO Meta Keywords</label>
                            <textarea name="seo_meta_keywords" class="form-control" rows="2" placeholder="comma separated keywords...">{{ old('seo_meta_keywords', $setting->seo_meta_keywords) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-5 py-3 border-top">
                <button type="submit" class="btn btn-primary px-5 py-2">Save All Settings</button>
            </div>
        </form>
    </div>
</div>
@endsection
