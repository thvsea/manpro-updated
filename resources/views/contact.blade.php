@extends('template.layout')
@section('section')

<!-- Meta Tags for SEO -->
@section('meta')
    <title>Contact Us - Your Company Name</title>
    <meta name="description" content="Get in touch with us for more information about our products and services. We're here to help!">
@endsection

<div class="container mx-auto p-6">
    <!-- Title -->
    <h1 class="text-4xl font-bold text-center">Contact Us</h1>
    <p class="text-gray-500 mt-2 text-center">Home > Contact</p>

    <!-- Contact Info -->
    <div class="flex justify-center items-center flex-col mt-8">
        <h2 class="text-xl font-bold">Get In Touch With Us</h2>
        <p class="text-center mt-2">For more information about our products & services, please feel free to drop us an email. Our staff is always here to help you out. Do not hesitate!</p>
        <p class="mt-2"><strong>Address:</strong> Jl. Teuku Umar No.9, Keprabon, Kec. Banjarsari, Kota Surakarta, Jawa Tengah 57131</p>
        <p class="mt-2"><strong>Phone:</strong> + (0271) 642732</p>
        <p class="mt-2"><strong>Working Time:</strong> Monday-Saturday: 7:30 - 17:00</p>
    </div>

    <!-- Contact Form -->
    <div class="w-full max-w-md mx-auto mt-10">
        <form>
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700">Your Name</label>
                <input type="text" id="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500" placeholder="Abc">
            </div>
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" id="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500" placeholder="Abc@def.com">
            </div>
            <div class="mb-6">
                <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
                <input type="text" id="subject" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500" placeholder="This is optional">
            </div>
            <div class="mb-6">
                <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                <textarea id="message" rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-yellow-500 focus:border-yellow-500" placeholder="Hi! I'd like to ask about"></textarea>
            </div>
            <button type="submit" class="w-full bg-yellow-500 text-white py-2 px-4 rounded-full">Submit</button>
        </form>
    </div>
</div>

@endsection
