<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home', [
            'title' => 'Home',
            'heroTitle' => 'One trusted home for services, portals, and resources.',
            'heroCopy' => 'Mirror Age Concepts brings together consulting, technology services, and digital learning in one clear gateway for clients, partners, and learners.',
            'services' => $this->services(),
            'resourceLinks' => $this->resourceLinks(),
            'gatewayCategories' => $this->gatewayCategories(),
        ]);
    }

    public function about()
    {
        return view('about', [
            'title' => 'About',
        ]);
    }

    public function contact()
    {
        return view('contact', [
            'title' => 'Contact',
        ]);
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:2500',
        ]);

        return redirect()->route('contact')->with('success', 'Your message has been received. We will contact you soon.');
    }

    private function services(): array
    {
        return [
            ['icon' => 'fa-solid fa-code', 'title' => 'Software Delivery', 'body' => 'Web platforms, internal tools, and business systems built with maintainability in mind.'],
            ['icon' => 'fa-solid fa-network-wired', 'title' => 'ICT and POS Setup', 'body' => 'Hardware rollout, device support, network readiness, and integrated operational workflows.'],
            ['icon' => 'fa-solid fa-palette', 'title' => 'Brand and Creative Support', 'body' => 'Identity design, print-ready materials, and digital assets aligned with your business goals.'],
        ];
    }

    private function resourceLinks(): array
    {
        return [
            ['label' => 'Organization Certificate', 'url' => '/api/file/doc/cac_mirror_age_concepts.pdf', 'variant' => 'primary'],
            ['label' => 'Company Profile', 'url' => '/api/file/buss_profile.pdf', 'variant' => 'success'],
            ['label' => 'Brand Assets', 'url' => '/api/file/doc/company_doc.zip', 'variant' => 'warning'],
        ];
    }

    private function gatewayCategories(): array
    {
        return [
            [
                'title' => 'Education and Exam Portals',
                'links' => [
                    ['label' => 'WAEC Direct', 'url' => 'https://www.waecdirect.org/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
                    ['label' => 'NECO', 'url' => 'https://www.neco.gov.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
                    ['label' => 'NABTEB', 'url' => 'https://nabteb.gov.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
                    ['label' => 'JAMB', 'url' => 'https://efacility.jamb.gov.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
                    ['label' => 'JAMB CAPS', 'url' => 'https://caps.jamb.gov.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
                    ['label' => 'Federal Ministry of Education', 'url' => 'https://education.gov.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
                    ['label' => 'National Universities Commission', 'url' => 'https://www.nuc.edu.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=education'],
                ],
            ],
            [
                'title' => 'Recruitment and Government Portals',
                'links' => [
                    ['label' => 'Nigerian Navy', 'url' => 'https://www.joinnigeriannavy.com?utm_source=mirrorage&utm_medium=gateway&utm_campaign=recruitment'],
                    ['label' => 'Nigeria Police', 'url' => 'https://www.npf.gov.ng?utm_source=mirrorage&utm_medium=gateway&utm_campaign=recruitment'],
                    ['label' => 'Nigerian Army', 'url' => 'https://recruitment.army.mil.ng?utm_source=mirrorage&utm_medium=gateway&utm_campaign=recruitment'],
                    ['label' => 'Nigerian Air Force', 'url' => 'https://airforce.mil.ng/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=recruitment'],
                ],
            ],
            [
                'title' => 'Business and Technology',
                'links' => [
                    ['label' => 'Corporate Affairs Commission', 'url' => 'https://www.cac.gov.ng?utm_source=mirrorage&utm_medium=gateway&utm_campaign=business'],
                    ['label' => 'National Library of Nigeria', 'url' => 'https://www.nln.gov.ng?utm_source=mirrorage&utm_medium=gateway&utm_campaign=business'],
                    ['label' => 'GitHub', 'url' => 'https://github.com/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=tech'],
                ],
            ],
            [
                'title' => 'Finance and Payments',
                'links' => [
                    ['label' => 'Paystack', 'url' => 'https://paystack.com/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=finance'],
                    ['label' => 'Flutterwave', 'url' => 'https://flutterwave.com/?utm_source=mirrorage&utm_medium=gateway&utm_campaign=finance'],
                ],
            ],
        ];
    }
}
