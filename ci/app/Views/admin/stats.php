<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Statistics</title>
    <!-- Tailwind CDN script -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Custom animation styles. This is required for advanced animations when using the CDN. -->
    <style type="text/tailwindcss">
        @layer utilities {
          @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
          }
          .animate-fade-in {
            animation: fadeIn 1s ease-out;
          }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-8 text-center animate-fade-in">Participant Statistics &nbsp; &nbsp; &nbsp; &nbsp; <a class="text-red-400" href="<?=base_url('/')?>">Dashboard</a></h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Card for TC Counts -->
            <div class="bg-white rounded-lg shadow-xl p-6 transform hover:scale-105 transition-transform duration-300">
                <h2 class="text-2xl font-bold text-gray-700 mb-4 border-b pb-2">LB Counts</h2>
                <?php if (!empty($tcCounts)): ?>
                    <div class="space-y-4">
                        <?php foreach ($tcCounts as $row): ?>
                            <div class="flex justify-between items-center bg-gray-50 p-4 rounded-lg shadow-sm">
                                <span class="text-gray-600 font-medium"><?= esc($row['lb']) ?></span>
                                <span class="text-lg font-bold text-indigo-600"><?= esc($row['count']) ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="p-4 bg-yellow-100 text-yellow-700 rounded-lg">
                        <p>No TC data found.</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Card for Gender Counts -->
            <div class="bg-white rounded-lg shadow-xl p-6 transform hover:scale-105 transition-transform duration-300">
                <h2 class="text-2xl font-bold text-gray-700 mb-4 border-b pb-2">Gender Counts</h2>
                <?php if (!empty($genderCounts)): ?>
                    <div class="space-y-4">
                        <?php foreach ($genderCounts as $row): ?>
                            <div class="flex justify-between items-center bg-gray-50 p-4 rounded-lg shadow-sm">
                                <span class="text-gray-600 font-medium"><?= esc($row['gender']) ?></span>
                                <span class="text-lg font-bold text-indigo-600"><?= esc($row['count']) ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="p-4 bg-yellow-100 text-yellow-700 rounded-lg">
                        <p>No gender data found.</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Card for Gender-TC Intersection Counts -->
            <div class="bg-white rounded-lg shadow-xl p-6 transform hover:scale-105 transition-transform duration-300">
                <h2 class="text-2xl font-bold text-gray-700 mb-4 border-b pb-2">Gender x LB Intersections</h2>
                <?php if (!empty($genderTcCounts)): ?>
                    <div class="space-y-4">
                        <?php foreach ($genderTcCounts as $i => $row): ?>
                            <div class="flex justify-between items-center bg-gray-50 p-4 rounded-lg shadow-sm">
                                <span class="text-gray-600 font-medium"><?= esc($row['gender']) . ' from ' . esc($row['lb']) ?></span>
                                <span class="text-lg font-bold text-indigo-600"><?= esc($row['count']) ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="p-4 bg-yellow-100 text-yellow-700 rounded-lg">
                        <p>No gender/TC intersection data found.</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Card for Gender-TC Intersection Counts -->
            <div class="bg-white rounded-lg shadow-xl p-6 transform hover:scale-105 transition-transform duration-300">
                <h2 class="text-2xl font-bold text-gray-700 mb-4 border-b pb-2">Category x Gender Intersections</h2>
                <?php if (!empty($AgeGenderCounts)): ?>
                    <div class="space-y-4">
                        <?php foreach ($AgeGenderCounts as $i => $row): ?>
                            <div class="flex justify-between items-center bg-gray-50 p-4 rounded-lg shadow-sm">
                                <span class="text-gray-600 font-medium"><?= esc($row['category']) . ' of ' . esc($row['gender']) ?></span>
                                <span class="text-lg font-bold text-indigo-600"><?= esc($row['count']) ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="p-4 bg-yellow-100 text-yellow-700 rounded-lg">
                        <p>No Age/gender intersection data found.</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Card for Age Counts -->
            <div class="bg-white rounded-lg shadow-xl p-6 transform hover:scale-105 transition-transform duration-300">
                <h2 class="text-2xl font-bold text-gray-700 mb-4 border-b pb-2">Age Counts</h2>
                <?php if (!empty($categoryCounts)): ?>
                    <div class="space-y-4">
                        <?php foreach ($categoryCounts as $row): ?>
                            <div class="flex justify-between items-center bg-gray-50 p-4 rounded-lg shadow-sm">
                                <span class="text-gray-600 font-medium"><?= esc($row['category']) ?></span>
                                <span class="text-lg font-bold text-indigo-600"><?= esc($row['count']) ?></td>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="p-4 bg-yellow-100 text-yellow-700 rounded-lg">
                        <p>No Age category data found.</p>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>

</body>
</html>
