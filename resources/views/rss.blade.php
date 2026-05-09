<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title>{{ config('app.name') }}</title>
        <link>{{ url('/') }}</link>
        <description>{{ SiteSetting::getValue('site_description', 'Personal website of Amrizal') }}</description>
        <language>{{ app()->getLocale() }}</language>
        <lastBuildDate>{{ now()->toRfc2822String() }}</lastBuildDate>
        <generator>Laravel</generator>
        <atom:link href="{{ route('rss') }}" rel="self" type="application/rss+xml" />
        @foreach($posts as $post)
        <item>
            <title><![CDATA[{{ $post->title }}]]></title>
            <link>{{ route('blog.show', $post->slug) }}</link>
            <guid isPermaLink="true">{{ route('blog.show', $post->slug) }}</guid>
            <pubDate>{{ $post->published_at->toRfc2822String() }}</pubDate>
            <description><![CDATA[{{ strip_tags($post->content) }}]]></description>
        </item>
        @endforeach
    </channel>
</rss>
