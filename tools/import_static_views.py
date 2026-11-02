#!/usr/bin/env python3
"""Read the original static HTML (without modifying it) and write Blade views."""
from __future__ import annotations

import re
from pathlib import Path

SRC = Path("/Users/tanjaplanchak/avtoskola-martin")
DST = Path("/Users/tanjaplanchak/avtoskola-martin-laravel/resources/views/pages")

PAGES = {
    "index.html": ("home.blade.php", "home"),
    "kategorii.html": ("categories.blade.php", "categories"),
    "tim.html": ("team.blade.php", "team"),
    "e-test.html": ("etest.blade.php", "etest"),
    "video.html": ("videos.blade.php", "videos"),
    "blog.html": ("blog/index.blade.php", "blog"),
    "kontakt.html": ("contact.blade.php", "contact"),
    "registracija.html": ("register.blade.php", "register"),
    "a-kategorija.html": ("categories/a-kategorija.blade.php", "categories"),
    "a1-kategorija.html": ("categories/a1-kategorija.blade.php", "categories"),
    "a2-kategorija.html": ("categories/a2-kategorija.blade.php", "categories"),
    "am-kategorija.html": ("categories/am-kategorija.blade.php", "categories"),
    "b-kategorija.html": ("categories/b-kategorija.blade.php", "categories"),
    "b-automatik.html": ("categories/b-automatik.blade.php", "categories"),
    "be-kategorija.html": ("categories/be-kategorija.blade.php", "categories"),
    "c-kategorija.html": ("categories/c-kategorija.blade.php", "categories"),
    "ce-kategorija.html": ("categories/ce-kategorija.blade.php", "categories"),
    "d-kategorija.html": ("categories/d-kategorija.blade.php", "categories"),
}


def extract_meta(html: str) -> tuple[str, str]:
    title = ""
    desc = ""
    m = re.search(r"<title>(.*?)</title>", html, re.I | re.S)
    if m:
        title = re.sub(r"\s+", " ", m.group(1)).strip()
    m = re.search(r'<meta name="description" content="([^"]*)"', html, re.I)
    if m:
        desc = m.group(1).strip()
    return title, desc


def extract_main(html: str) -> str:
    m = re.search(r"<main[^>]*>(.*)</main>", html, re.I | re.S)
    if not m:
        raise SystemExit("No <main> found")
    return m.group(1).strip()


def rewrite(html: str) -> str:
    html = re.sub(
        r'href="blog-([^"]+?)\.html"',
        r'href="{{ route(\'blog.show\', \'\1\') }}"',
        html,
    )
    html = html.replace('href="index.html"', 'href="{{ route(\'home\') }}"')
    html = html.replace('href="kategorii.html"', 'href="{{ route(\'categories\') }}"')
    html = html.replace('href="tim.html"', 'href="{{ route(\'team\') }}"')
    html = html.replace('href="e-test.html"', 'href="{{ route(\'etest\') }}"')
    html = html.replace('href="video.html"', 'href="{{ route(\'videos\') }}"')
    html = html.replace('href="blog.html"', 'href="{{ route(\'blog\') }}"')
    html = html.replace('href="kontakt.html"', 'href="{{ route(\'contact\') }}"')
    html = re.sub(
        r'href="registracija\.html(?:\?cat=([^"]+))?"',
        lambda m: (
            'href="{{ route(\'register\', [\'cat\' => \'' + m.group(1) + '\']) }}"'
            if m.group(1)
            else 'href="{{ route(\'register\') }}"'
        ),
        html,
    )
    html = html.replace('href="a-kategorija.html"', 'href="{{ route(\'category\', \'a-kategorija\') }}"')
    html = html.replace('href="a1-kategorija.html"', 'href="{{ route(\'category\', \'a1-kategorija\') }}"')
    html = html.replace('href="a2-kategorija.html"', 'href="{{ route(\'category\', \'a2-kategorija\') }}"')
    html = html.replace('href="am-kategorija.html"', 'href="{{ route(\'category\', \'am-kategorija\') }}"')
    html = html.replace('href="b-kategorija.html"', 'href="{{ route(\'category\', \'b-kategorija\') }}"')
    html = html.replace('href="b-automatik.html"', 'href="{{ route(\'category\', \'b-automatik\') }}"')
    html = html.replace('href="be-kategorija.html"', 'href="{{ route(\'category\', \'be-kategorija\') }}"')
    html = html.replace('href="c-kategorija.html"', 'href="{{ route(\'category\', \'c-kategorija\') }}"')
    html = html.replace('href="ce-kategorija.html"', 'href="{{ route(\'category\', \'ce-kategorija\') }}"')
    html = html.replace('href="d-kategorija.html"', 'href="{{ route(\'category\', \'d-kategorija\') }}"')
    html = re.sub(r'(?:src|href)="(images/[^"]+)"', r'src="{{ asset(\'\1\') }}"', html)
    html = html.replace('src="{{ asset(\'', 'src="{{ asset(\'')  # noop safety
    # fix accidental href->src for images used as href (none expected)
    html = re.sub(
        r'src="\{\{ asset\(\'(images/[^"]+)\'\) \}\}"',
        r'src="{{ asset(\'\1\') }}"',
        html,
    )
    return html


def wrap(title: str, desc: str, nav: str, body: str) -> str:
    title_esc = title.replace("'", "\\'")
    desc_esc = desc.replace("'", "\\'")
    return (
        "@extends('layouts.app')\n"
        f"@section('title', '{title_esc}')\n"
        f"@section('description', '{desc_esc}')\n"
        f"@section('nav', '{nav}')\n"
        "@section('content')\n"
        f"{body}\n"
        "@endsection\n"
    )


def convert_blog_article(path: Path) -> None:
    html = path.read_text(encoding="utf-8")
    title, desc = extract_meta(html)
    body = rewrite(extract_main(html))
    slug = path.name[len("blog-") : -len(".html")]
    out = DST / "blog" / f"{slug}.blade.php"
    out.parent.mkdir(parents=True, exist_ok=True)
    out.write_text(wrap(title, desc, "blog", body), encoding="utf-8")
    print("wrote", out.relative_to(DST.parent.parent))


def main() -> None:
    DST.mkdir(parents=True, exist_ok=True)
    (DST / "categories").mkdir(exist_ok=True)
    (DST / "blog").mkdir(exist_ok=True)

    for src_name, (dest_rel, nav) in PAGES.items():
        src = SRC / src_name
        html = src.read_text(encoding="utf-8")
        title, desc = extract_meta(html)
        body = rewrite(extract_main(html))
        if dest_rel == "contact.blade.php":
            body = body.replace(
                '<form id="contactForm" method="post" action="api/contact.php" novalidate>',
                '<form id="contactForm" method="post" action="{{ route(\'contact.store\') }}" novalidate>\n          @csrf',
            )
        if dest_rel == "register.blade.php":
            body = body.replace(
                '<form class="reg-form-wrap" id="regForm" novalidate>',
                '<form class="reg-form-wrap" id="regForm" method="post" action="{{ route(\'register.store\') }}" novalidate>\n          @csrf',
            )
        out = DST / dest_rel
        out.parent.mkdir(parents=True, exist_ok=True)
        out.write_text(wrap(title, desc, nav, body), encoding="utf-8")
        print("wrote", dest_rel)

    for path in sorted(SRC.glob("blog-*.html")):
        convert_blog_article(path)


if __name__ == "__main__":
    main()
