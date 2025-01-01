<div class="flex flex-col items-center justify-center relative pb-4 bg-[#D6E4F0]">
    <div class="my-5 flex flex-col items-center">
        <h2 class="font-bold text-[#1E56A0] text-center text-2xl md:text-4xl">Kontak</h2>
    </div>
    <div class="shadow-xl p-4 w-[90%] md:w-auto rounded-[8px] bg-white">
        <form>
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base/7 font-semibold text-gray-900"></h2>
                    <p class="mt-1 text-sm/6 text-gray-600"></p>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="first-name" class="block text-sm/6 font-medium text-gray-900">First
                                name</label>
                            <div class="mt-2">
                                <input type="text" name="first-name" id="first-name" autocomplete="given-name"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-[#1E56A0] sm:text-sm/6">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="last-name" class="block text-sm/6 font-medium text-gray-900">Last
                                name</label>
                            <div class="mt-2">
                                <input type="text" name="last-name" id="last-name" autocomplete="family-name"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-[#1E56A0] sm:text-sm/6">
                            </div>
                        </div>

                        <div class="sm:col-span-full">
                            <label for="email" class="block text-sm/6 font-medium text-gray-900">Email
                                address</label>
                            <div class="mt-2">
                                <input id="email" name="email" type="email" autocomplete="email"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-[#1E56A0] sm:text-sm/6">
                            </div>
                        </div>

                        <div class="col-span-full">
                            <label for="feedback" class="block text-sm/6 font-medium text-gray-900">Pesan</label>
                            <div class="mt-2">
                                <textarea type="text" name="feedback" id="feedback" autocomplete="feedback"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-[#1E56A0] sm:text-sm/6"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="submit"
                    class="rounded-md bg-[#1E56A0] px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-[#22497b] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#1E56A0]">Kirim</button>
            </div>
    </div>
    </form>
</div>


</div>
