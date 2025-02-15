<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title></title>
</head>

<body>
    <header>
        <a href="/login">
            <h2>ログイン</h2>
        </a>
    </header>

    <main>
        <h2 v-html="title"></h2>
        <button v-on:click="buttonClick">変更</button>

        <form action="">
            <p v-html="validateResult"></p>
            <input type="text" name="name" v-model="name">
            <button type="button" v-on:click="validate">ひらがな確認</button>
        </form>
    </main>

    <script src="/js/build/top/index.js"></script>
</body>

</html>