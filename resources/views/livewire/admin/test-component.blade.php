<div class="mt-5">
    <div x-data="{
    open: false,
    show : true
    }">
        <button class="btn btn-outline-primary" @click="open = ! open">Toggle Content</button>

{{--        <img @mouseenter="open = true" @mouseleave="open = false" src="{{ asset('admin/assets/img/news/img08.jpg') }}" alt="">--}}


        <div x-show="open" x-transition.duration.200ms>
            <div class="row">
                <div class="col-sm-4 mt-2">
                    <article class="article">
                        <div class="article-header">
                            <div class="article-image" data-background="assets/img/news/img08.jpg" style="background-image: url(&quot;assets/img/news/img08.jpg&quot;);">
                            </div>
                            <div class="article-title">
                                <h2><a href="#">Excepteur sint occaecat cupidatat non proident</a></h2>
                            </div>
                        </div>
                        <div class="article-details">
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. </p>
                            <div class="article-cta">
                                <a href="#" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-3" x-data="{
    showModal: false,
    selectedId: null,
    name : '',
    price : 0
    }">
        <!-- Кнопка для открытия модального окна с передачей параметра id -->
        <button @click="selectedId = 1; showModal = true; name='Product1'; price='125,00'" class="btn btn-primary">
            Открыть модальное окно
        </button>

        <!-- Модальное окно -->
        <div x-show="showModal"
             style="display: none;"
             x-transition.duration.250ms
             class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
            <div class="bg-white p-6 rounded-lg w-1/3">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-bold">Детали элемента (ID: <span x-text="selectedId"></span>)</h2>
                    <button @click="showModal = false" class="text-red-500">&times;</button>
                </div>
                <div class="mt-4">
                    <!-- Контент модального окна, можно использовать selectedId -->
                    Информация по элементу с ID: <span x-text="selectedId"></span>
                    <p>Name: <b><span x-text="name"></span></b> </p>
                    <p>Price: <b><span x-text="price"></span></b></p>
                </div>
                <div class="mt-4 text-right">
                    <button @click="showModal = false" class="btn btn-secondary">Закрыть</button>
                </div>
            </div>
        </div>
    </div>

</div>
