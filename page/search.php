<?php require "header.php"; ?>

<form method="POST" class="ml-0 p-8 xl:ml-10 xl:p-10">
    <input type="text" name="search" onkeyup="find()" placeholder="Taper votre recherche..." class="text-white bg-black p-2 text-xs pr-10 sm:pr-25 lg:pr-35 xl:pr-60" id="search">
</form>

<div class="result grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-y-6 pb-6 sm:gap-x-8 sm:gap-y-8 lg:gap-x-10 lg:gap-y-10 lg:px-14 sm:mb-8 lg:mb-10 px-10  xl:gap-x-14 xl:p-40 text-center xl:gap-y-14 xl:pt-10 xl:pb-10">

</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="../assets/js/search.js"></script>

</body>
</html>