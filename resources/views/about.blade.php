@extends('template.layout')

@section('title', 'About Us - Mekarsari Fabric Store')
@section('meta-description', 'Learn more about Mekarsari, a trusted provider of high-quality fabrics and sewing accessories. Explore our origin, mission, and future goals.')

@section('section')

<div class="container mx-auto py-12">
    <!-- Breadcrumbs -->
    <nav class="text-gray-600 text-sm my-6" aria-label="Breadcrumb">
        <a href="/home" class="text-gray-500 hover:text-gray-900">Home</a> >
        <span class="text-gray-900">About Us</span>
    </nav>
    
    <!-- Hero Image Section -->
    <div class="relative bg-cover bg-center h-96" style="background-image: url('https://www.hawthornintl.com/wp-content/uploads/2018/11/Denim-Fabric.jpg');">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative z-10 flex justify-center items-center h-full">
            <h1 class="text-white text-5xl font-bold">About Us</h1>
        </div>
    </div>

    <!-- About Section -->
    <section class="text-center my-12">
        <h2 class="text-4xl font-bold mb-4">Who We Are</h2>
        <p class="text-gray-600 text-lg max-w-2xl mx-auto">
            Welcome to <strong>Mekarsari</strong>, where our mission is to provide top-tier fabrics and sewing accessories. 
            Founded in the 1990's, we have always believed in delivering quality, unique products, and exceptional service
            to our customers.
        </p>
    </section>

    <!-- Origin Section with Image -->
    <section class="my-12 flex flex-col lg:flex-row items-center">
        <div class="lg:w-1/2 mb-8 lg:mb-0">
            <img src="https://lh5.googleusercontent.com/p/AF1QipP3bQWvDXcPOxUUVbwYoy1C5jM_AFuTO4PfsjUk=w408-h541-k-no" 
                 alt="Mekarsari's Origin - Fabric Store in Solo, Indonesia" 
                 class="w-full rounded-lg shadow-lg">
        </div>
        <div class="lg:w-1/2 lg:pl-12">
            <h2 class="text-3xl font-semibold mb-4">Our Origin</h2>
            <p class="text-gray-600 leading-relaxed">
                Our journey began as a small family-run fabric store in Solo, Indonesia. Through passion and dedication, 
                we expanded our vision, growing into a recognized brand for high-quality textiles and sewing supplies.
                We always believed in creating a place where customers could find everything they needed for their creative projects.
            </p>
        </div>
    </section>

    <!-- Mission Section with Background -->
    <section class="py-12 bg-gray-100">
        <div class="text-center">
            <h2 class="text-3xl font-semibold mb-4">Our Mission</h2>
            <p class="text-gray-600 leading-relaxed max-w-2xl mx-auto">
                At Mekarsari, our mission is to empower people to create through the finest fabrics and supplies.
                We believe that creativity should be nurtured, which is why we offer high-quality materials to all of our customers.
            </p>
        </div>
    </section>

    <!-- Future Goals Section with Image -->
    <section class="my-12 flex flex-col lg:flex-row items-center">
        <div class="lg:w-1/2 lg:pr-12 mb-8 lg:mb-0">
            <h2 class="text-3xl font-semibold mb-4">Our Future Goals</h2>
            <p class="text-gray-600 leading-relaxed">
                Our future plans include expanding our product lines and enhancing our online platform to reach more customers.
                We aim to create an easier, more enjoyable shopping experience, allowing customers to explore new ideas,
                fabrics, and tools. We're excited to see how our community of creators grows!
            </p>
        </div>
        <div class="lg:w-1/2">
            <img src="https://img.freepik.com/premium-photo/silhouettes-people-standing-top-holding-hands-cheering-sunset-concept-symbolizes_1095814-10552.jpg" 
                 alt="Future Goals of Mekarsari Fabric Store" 
                 class="w-full rounded-lg shadow-lg">
        </div>
    </section>

    <!-- Conclusion -->
    <section class="text-center my-12">
        <p class="text-gray-600 text-lg max-w-2xl mx-auto">
            We are proud to be a part of your creative journey. Thank you for choosing Mekarsari for all your textile needs.
            Feel free to reach out to us if you have any questions or suggestions.
        </p>
        <p class="text-gray-800 font-bold mt-4">Sincerely, Our Team at Mekarsari</p>
    </section>
</div>

@endsection
