<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="kisspng-earth-world-map-globe-vector-hand-planet-5a9af8cfde0632.1928504515201056799094.png"
        type="image/x-icon">
    <title>EcoRecycle | Resources</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .resource-bg {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('bg-resources.jpg');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body class="font-['Poppins'] bg-gray-50">
    <?php include 'navigation.php'; ?>

    <div class="container mx-auto px-4 py-8">
        <!-- Hero Section -->
        <section class="resource-bg text-white py-20">
            <div class="container mx-auto px-4 text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">E-Waste Resources</h1>
                <p class="text-xl mb-8 max-w-2xl mx-auto">Learn how to properly recycle electronics and reduce e-waste</p>
            </div>
        </section>

        <!-- Main Content -->
        <section class="py-12 bg-white">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row gap-8">
                    <!-- Sidebar -->
                    <div class="md:w-1/4">
                        <div class="bg-gray-50 p-6 rounded-lg sticky top-24">
                            <h3 class="text-lg font-semibold mb-4 text-emerald-600">Resource Categories</h3>
                            <ul class="space-y-2">
                                <li>
                                    <button onclick="filterResources('all')"
                                        class="text-left w-full px-3 py-2 rounded hover:bg-emerald-100 text-emerald-600 font-medium">
                                        <i class="fas fa-list mr-2"></i>All Resources
                                    </button>
                                </li>
                                <li>
                                    <button onclick="filterResources('guides')"
                                        class="text-left w-full px-3 py-2 rounded hover:bg-emerald-100 text-gray-700">
                                        <i class="fas fa-book mr-2"></i>Guides
                                    </button>
                                </li>
                                <li>
                                    <button onclick="filterResources('videos')"
                                        class="text-left w-full px-3 py-2 rounded hover:bg-emerald-100 text-gray-700">
                                        <i class="fas fa-video mr-2"></i>Videos
                                    </button>
                                </li>
                                <li>
                                    <button onclick="filterResources('articles')"
                                        class="text-left w-full px-3 py-2 rounded hover:bg-emerald-100 text-gray-700">
                                        <i class="fas fa-newspaper mr-2"></i>Articles
                                    </button>
                                </li>
                                <li>
                                    <button onclick="filterResources('tools')"
                                        class="text-left w-full px-3 py-2 rounded hover:bg-emerald-100 text-gray-700">
                                        <i class="fas fa-tools mr-2"></i>Tools
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Resources List -->
                    <div class="md:w-3/4">
                        <div class="mb-8">
                            <h2 class="text-2xl font-bold text-emerald-600 mb-4">Educational Materials</h2>
                            <p class="text-gray-600">Browse our collection of resources to learn more about e-waste
                                recycling and its importance.</p>
                        </div>

                        <!-- Search Box -->
                        <div class="mb-8">
                            <div class="relative">
                                <input type="text" id="resourceSearch" placeholder="Search resources..."
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent">
                                <button class="absolute right-3 top-3 text-gray-400 hover:text-emerald-600">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Resources Grid -->
                        <div id="resourcesContainer" class="grid md:grid-cols-2 gap-6">
                            <!-- Resource Card 1 -->
                            <div class="resource-card bg-gray-50 p-6 rounded-lg border-l-4 border-emerald-600"
                                data-category="guides">
                                <div class="flex items-center mb-4">
                                    <div class="bg-emerald-100 text-emerald-600 p-3 rounded-full mr-4">
                                        <i class="fas fa-book text-xl"></i>
                                    </div>
                                    <h3 class="text-xl font-semibold">Beginner's Guide to E-Waste</h3>
                                </div>
                                <p class="text-gray-600 mb-4">Learn what constitutes e-waste and how to identify items that
                                    should be recycled.</p>
                                <a href="https://wasteaid.org/wp-content/uploads/2022/06/Handbook-of-E-waste-management.pdf" class="text-emerald-600 font-medium inline-flex items-center">
                                    Read Guide <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>

                            <!-- Resource Card 2 -->
                            <div class="resource-card bg-gray-50 p-6 rounded-lg border-l-4 border-emerald-600"
                                data-category="videos">
                                <div class="flex items-center mb-4">
                                    <div class="bg-emerald-100 text-emerald-600 p-3 rounded-full mr-4">
                                        <i class="fas fa-video text-xl"></i>
                                    </div>
                                    <h3 class="text-xl font-semibold">The E-Waste Process</h3>
                                </div>
                                <p class="text-gray-600 mb-4">Watch how electronics are properly recycled in certified
                                    facilities.</p>
                                <a href="videos.html" class="text-emerald-600 font-medium inline-flex items-center">
                                    Watch Video <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>

                            <!-- Resource Card 3 -->
                            <div class="resource-card bg-gray-50 p-6 rounded-lg border-l-4 border-emerald-600"
                                data-category="articles">
                                <div class="flex items-center mb-4">
                                    <div class="bg-emerald-100 text-emerald-600 p-3 rounded-full mr-4">
                                        <i class="fas fa-newspaper text-xl"></i>
                                    </div>
                                    <h3 class="text-xl font-semibold">Global E-Waste Statistics</h3>
                                </div>
                                <p class="text-gray-600 mb-4">Recent findings about the growing e-waste problem worldwide.
                                </p>
                                <a href="https://www.statista.com/topics/3409/electronic-waste-worldwide/#topicOverview" class="text-emerald-600 font-medium inline-flex items-center">
                                    Read Article <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>

                            <!-- Resource Card 4 -->
                            <div class="resource-card bg-gray-50 p-6 rounded-lg border-l-4 border-emerald-600"
                                data-category="tools">
                                <div class="flex items-center mb-4">
                                    <div class="bg-emerald-100 text-emerald-600 p-3 rounded-full mr-4">
                                        <i class="fas fa-tools text-xl"></i>
                                    </div>
                                    <h3 class="text-xl font-semibold">E-Waste Impact Calculator</h3>
                                </div>
                                <p class="text-gray-600 mb-4">Calculate how much e-waste you generate and its environmental
                                    impact.</p>
                                <a href="http://www.ewasterecyclingplant.com/PCB_circuit_board_recycling_machine/e_waste_recycling_equipment_list_238.html" class="text-emerald-600 font-medium inline-flex items-center">
                                    Use Tool <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>

                            <!-- Resource Card 5 -->
                            <div class="resource-card bg-gray-50 p-6 rounded-lg border-l-4 border-emerald-600"
                                data-category="guides">
                                <div class="flex items-center mb-4">
                                    <div class="bg-emerald-100 text-emerald-600 p-3 rounded-full mr-4">
                                        <i class="fas fa-book text-xl"></i>
                                    </div>
                                    <h3 class="text-xl font-semibold">Data Security When Recycling</h3>
                                </div>
                                <p class="text-gray-600 mb-4">Step-by-step guide to protecting your data before recycling
                                    devices.</p>
                                <a href="https://levelblue.com/blogs/security-essentials/securely-disposing-of-old-electronics-and-data-a-forensic-guide-to-protecting-your-information" class="text-emerald-600 font-medium inline-flex items-center">
                                    Read Guide <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>

                            <!-- Resource Card 6 -->
                            <div class="resource-card bg-gray-50 p-6 rounded-lg border-l-4 border-emerald-600"
                                data-category="articles">
                                <div class="flex items-center mb-4">
                                    <div class="bg-emerald-100 text-emerald-600 p-3 rounded-full mr-4">
                                        <i class="fas fa-newspaper text-xl"></i>
                                    </div>
                                    <h3 class="text-xl font-semibold">Recycling Laws by State</h3>
                                </div>
                                <p class="text-gray-600 mb-4">Overview of e-waste recycling regulations in different states.
                                </p>
                                <a href="https://www.amiplastics.com/insights/state-level-24-states-have-signed-chemical-recycling-laws" class="text-emerald-600 font-medium inline-flex items-center">
                                    Read Article <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Newsletter Section -->
        <section class="py-12 bg-emerald-600 text-white">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl font-bold mb-4">Stay Updated</h2>
                <p class="text-xl mb-8 max-w-2xl mx-auto">Subscribe to our newsletter for the latest e-waste recycling
                    resources and news</p>
                <!-- <div class="max-w-md mx-auto">
                    <div class="flex flex-col sm:flex-row gap-2">
                        <input type="email" placeholder="Your email address"
                            class="flex-grow px-4 py-3 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-white">
                        <button
                            class="bg-white text-emerald-600 font-bold px-6 py-3 rounded-lg hover:bg-gray-100 transition">
                            Subscribe
                        </button>
                    </div>
                </div> -->
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="py-12 bg-white">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center text-emerald-600 mb-12">Frequently Asked Questions</h2>
                <div class="max-w-3xl mx-auto space-y-4">
                    <!-- FAQ Item 1 -->
                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <button
                            class="faq-toggle w-full text-left p-4 bg-gray-50 hover:bg-gray-100 flex justify-between items-center">
                            <span class="font-medium">What items are considered e-waste?</span>
                            <i class="fas fa-chevron-down transition-transform duration-300"></i>
                        </button>
                        <div class="faq-content hidden p-4 bg-white">
                            <p class="text-gray-600">E-waste includes any electronic device that is no longer wanted or
                                functional. Common examples include computers, laptops, monitors, TVs, mobile phones,
                                tablets, printers, scanners, and other electronic equipment.</p>
                        </div>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <button
                            class="faq-toggle w-full text-left p-4 bg-gray-50 hover:bg-gray-100 flex justify-between items-center">
                            <span class="font-medium">Why is e-waste recycling important?</span>
                            <i class="fas fa-chevron-down transition-transform duration-300"></i>
                        </button>
                        <div class="faq-content hidden p-4 bg-white">
                            <p class="text-gray-600">E-waste contains hazardous materials like lead, mercury, and cadmium
                                that can harm the environment if not disposed of properly. Recycling also recovers valuable
                                materials like gold, silver, and copper, reducing the need for mining.</p>
                        </div>
                    </div>

                    <!-- FAQ Item 3 -->
                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <button
                            class="faq-toggle w-full text-left p-4 bg-gray-50 hover:bg-gray-100 flex justify-between items-center">
                            <span class="font-medium">How can I ensure my data is secure when recycling?</span>
                            <i class="fas fa-chevron-down transition-transform duration-300"></i>
                        </button>
                        <div class="faq-content hidden p-4 bg-white">
                            <p class="text-gray-600">Always back up your data, then perform a factory reset or use data
                                wiping software. For added security, physically destroy hard drives or use certified
                                recyclers that provide data destruction services.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white pt-12 pb-6">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="text-xl font-bold mb-4 flex items-center gap-2">
                        <i class="fas fa-recycle"></i> EcoRecycle
                    </h3>
                    <p class="mb-4 text-gray-300">Helping communities recycle electronics responsibly since 2020.</p>
                    <div class="flex gap-4">
                        <a href="#" class="text-gray-300 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-300 hover:text-white"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-300 hover:text-white"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="Home.php" class="text-gray-300 hover:text-white">Home</a></li>
                        <li><a href="Facility.php" class="text-gray-300 hover:text-white">Find Centers</a></li>
                        <li><a href="Resources.html" class="text-gray-300 hover:text-white">Accepted Items</a></li>
                        <li><a href="contact.php" class="text-gray-300 hover:text-white">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Resources</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white">E-Waste Facts</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Recycling Process</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Data Security</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li class="flex items-start gap-2">
                            <i class="fas fa-map-marker-alt mt-1"></i>
                            <span>123 Green Ave, Eco City, EC 12345</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-phone"></i>
                            <span>(800) 555-RECYCLE</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-envelope"></i>
                            <span>info@ecorecycle.org</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 pt-6 text-center text-gray-400">
                <p>This initiative supports responsible e-waste management and sustainability.</p>
                <p class="mt-2">© 2023 EcoRecycle. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // FAQ toggle functionality
        document.querySelectorAll('.faq-toggle').forEach(button => {
            button.addEventListener('click', () => {
                const content = button.nextElementSibling;
                const icon = button.querySelector('i');

                // Toggle content visibility
                content.classList.toggle('hidden');

                // Rotate icon
                icon.classList.toggle('transform');
                icon.classList.toggle('rotate-180');
            });
        });

        // Resource filtering
        function filterResources(category) {
            const resources = document.querySelectorAll('.resource-card');
            const categoryButtons = document.querySelectorAll('[onclick^="filterResources"]');

            // Update active button styling
            categoryButtons.forEach(btn => {
                if (btn.getAttribute('onclick').includes(category)) {
                    btn.classList.add('text-emerald-600', 'font-medium');
                    btn.classList.remove('text-gray-700');
                } else {
                    btn.classList.remove('text-emerald-600', 'font-medium');
                    btn.classList.add('text-gray-700');
                }
            });

            // Show/hide resources based on category
            resources.forEach(resource => {
                if (category === 'all' || resource.getAttribute('data-category') === category) {
                    resource.style.display = 'block';
                } else {
                    resource.style.display = 'none';
                }
            });
        }

        // Simple search functionality
        const searchInput = document.getElementById('resourceSearch');
        searchInput.addEventListener('input', () => {
            const searchTerm = searchInput.value.toLowerCase();
            const resources = document.querySelectorAll('.resource-card');

            resources.forEach(resource => {
                const title = resource.querySelector('h3').textContent.toLowerCase();
                const description = resource.querySelector('p').textContent.toLowerCase();

                if (title.includes(searchTerm) || description.includes(searchTerm)) {
                    resource.style.display = 'block';
                } else {
                    resource.style.display = 'none';
                }
            });
        });

        // NEW: Auto-filter when arriving from home page
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const filterParam = urlParams.get('filter');
            
            if (filterParam && ['guides', 'articles', 'tools', 'videos'].includes(filterParam)) {
                filterResources(filterParam);
                
                // Highlight the active category button
                document.querySelectorAll('[onclick^="filterResources"]').forEach(btn => {
                    if (btn.getAttribute('onclick').includes(filterParam)) {
                        btn.classList.add('text-emerald-600', 'font-medium');
                        btn.classList.remove('text-gray-700');
                    }
                });
            }
        });
    </script>
</body>
</html>