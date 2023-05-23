<?php
/* @var $this \yii\web\View */

/* @var $content string */

use app\models\Blog;
use app\models\Book;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\bootstrap5\LinkPager;

$this->title = ' ';
\app\assets\FrontendAsset::register($this);

?>
<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>UZSCOOL</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/cover/">
    <link href="<?= Yii::getAlias('@web') ?>/front/assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= Yii::getAlias('@web') ?>/front/assets/dist/css/cover.css" rel="stylesheet">
</head>
<body class="d-block w-100 text-center text-white">

<div class="container-fluid position-relative p-0">

    <header class="mb-5 books">
        <nav class="navbar nav-masthead navbar-expand-lg navbar-dark bg-transparent"
             aria-label="Fifth navbar example">
            <div class="container-fluid">
                <a class="navbar-brand" href="/frontend/index">
                    <svg width="130" height="128" viewBox="0 0 130 128" fill="none" class="d-block my-1"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M32.9412 22.2666H50.2056C50.2056 22.4826 50.2056 22.6789 50.2056 22.875C50.2082 34.4177 50.1978 45.9604 50.223 57.504C50.2288 60.3718 50.6806 63.1733 51.8334 65.8294C53.2728 69.1416 55.735 71.3821 59.0305 72.7564C60.7222 73.4617 62.4854 73.8783 64.3503 74.0684C64.302 79.8284 64.2539 85.5645 64.2047 91.3833C63.2704 91.3055 62.3862 91.263 61.5098 91.1525C57.4921 90.6451 53.6597 89.505 50.0496 87.6605C44.1032 84.6222 39.6323 80.0991 36.6375 74.1212C34.8364 70.5272 33.753 66.7049 33.3316 62.7159C33.0963 60.4886 32.9611 58.2404 32.9542 56.0016C32.918 44.962 32.9403 33.9233 32.9412 22.8837C32.9412 22.6859 32.9412 22.4887 32.9412 22.2666Z"
                            fill="white"/>
                        <path
                            d="M94.2721 35.0498C95.1982 35.572 96.0492 36.0391 96.883 36.5364C96.9881 36.5992 97.044 36.8208 97.0448 36.9699C97.057 38.3187 97.0526 39.6672 97.0518 41.0151C97.0492 46.7106 97.1001 52.4061 97.0286 58.1008C96.964 63.3042 96.0785 68.3664 93.943 73.1554C91.7293 78.1201 88.3948 82.1601 83.9018 85.2315C79.4916 88.246 74.5971 90.0084 69.3418 90.8072C68.1822 90.9832 67.0066 91.0477 65.8377 91.1606C65.7135 91.1728 65.587 91.1624 65.4336 91.1624V88.4287C66.2502 88.3546 67.0486 88.3065 67.8412 88.2072C73.8348 87.4567 79.3434 85.4694 84.081 81.6414C88.9564 77.703 91.8258 72.5201 93.2384 66.4747C93.9896 63.2611 94.2687 59.9968 94.2704 56.7039C94.2747 49.6889 94.2713 42.6732 94.2713 35.6582C94.2713 35.4868 94.2713 35.3152 94.2713 35.0498H94.2721Z"
                            fill="white"/>
                        <path
                            d="M88.1706 18.7998C90.7411 20.7123 93.2791 22.5988 95.8156 24.4869C96.2808 24.8331 96.9228 25.0985 97.152 25.5615C97.3899 26.0421 97.2333 26.7177 97.2342 27.3077C97.2378 29.8481 97.2359 32.3876 97.2359 34.928C97.2359 35.086 97.2359 35.2437 97.2359 35.4805C97.0532 35.3817 96.9185 35.3131 96.7883 35.2377C94.0427 33.6374 91.2947 32.0407 88.5562 30.4274C88.2659 30.2565 88.0603 30.2556 87.7699 30.4274C85.069 32.0191 82.3596 33.594 79.6517 35.1727C79.4924 35.2654 79.3297 35.3505 79.0909 35.4831V34.9514C79.0909 31.9634 79.0955 28.9764 79.084 25.9884C79.0831 25.6684 79.1741 25.4679 79.44 25.271C82.2187 23.2215 84.986 21.1563 87.7576 19.0956C87.8854 19.001 88.0156 18.9108 88.1714 18.7998H88.1706Z"
                            fill="white"/>
                        <path
                            d="M89.2643 32.0166C90.2116 32.537 91.0767 33.0083 91.9352 33.4923C92.0043 33.5313 92.0509 33.6514 92.0647 33.7395C92.0864 33.8806 92.0725 34.0266 92.0725 34.1701C92.0751 41.6975 92.0951 49.2256 92.0743 56.7528C92.0621 61.3132 91.4845 65.7863 89.7962 70.0637C87.2478 76.5199 82.7814 81.1417 76.4723 83.998C73.582 85.3069 70.5467 86.0858 67.4068 86.4706C66.767 86.5492 66.1202 86.5674 65.4336 86.6166V83.8736C66.5356 83.7308 67.6193 83.6236 68.6927 83.4446C73.7367 82.6052 78.2184 80.5762 81.9481 77.0265C84.0691 75.0089 85.6529 72.6072 86.8203 69.9246C87.9706 67.28 88.6813 64.5162 88.9681 61.6564C89.1486 59.8565 89.2435 58.0402 89.2505 56.2315C89.2806 48.3732 89.2643 40.5138 89.2643 32.6556C89.2643 32.4749 89.2643 32.2942 89.2643 32.0166Z"
                            fill="white"/>
                        <path
                            d="M87.0673 32.0166C87.0777 32.2419 87.0916 32.3945 87.0916 32.5464C87.0942 40.6276 87.1115 48.708 87.0881 56.7894C87.0777 60.3514 86.6648 63.8625 85.4865 67.2546C83.3001 73.5518 79.1024 77.9072 72.8798 80.3086C70.6992 81.1494 68.4375 81.6506 66.1068 81.8369C65.949 81.8499 65.7894 81.8491 65.6305 81.8499C65.5751 81.8499 65.5203 81.8361 65.4336 81.8239V79.0922C66.1807 78.9995 66.9269 78.9405 67.6601 78.8105C72.1015 78.019 76.0232 76.2203 79.0972 72.8262C80.9478 70.783 82.1964 68.3938 83.0215 65.7774C83.6531 63.775 84.047 61.7212 84.1469 59.6275C84.2387 57.6979 84.2569 55.7639 84.2606 53.8315C84.2736 47.2942 84.271 40.7576 84.2543 34.2203C84.2535 33.746 84.3629 33.4626 84.814 33.2477C85.5637 32.8904 86.2752 32.4554 87.0656 32.0175L87.0673 32.0166Z"
                            fill="white"/>
                        <path
                            d="M81.887 34.8335C81.887 35.1043 81.887 35.261 81.887 35.4185C81.8894 42.5208 81.9161 49.6232 81.8862 56.7255C81.8714 60.1142 81.4229 63.4402 80.0991 66.5977C78.205 71.1137 74.9899 74.222 70.4065 75.8825C68.9609 76.406 67.4726 76.7217 65.9458 76.8601C65.7913 76.874 65.6336 76.8618 65.4336 76.8618V74.2469C66.8207 73.9017 68.2061 73.669 69.5152 73.2112C73.2973 71.8883 75.9447 69.3002 77.5078 65.5889C78.67 62.8277 79.0767 59.9211 79.0827 56.9445C79.0964 50.2316 79.0998 43.5186 79.1152 36.8065C79.1152 36.6689 79.1685 36.4637 79.2654 36.4032C80.1 35.8839 80.9502 35.3908 81.8886 34.8344L81.887 34.8335Z"
                            fill="white"/>
                        <path
                            d="M76.9158 98.0264C76.7689 98.6162 76.7017 99.2399 76.4599 99.7892C75.8762 101.115 74.4336 101.761 72.8013 101.515C71.2798 101.287 70.2537 100.292 70.0496 98.82C69.9124 97.8331 69.9538 96.862 70.4732 95.9693C71.2064 94.7092 72.6481 94.1715 74.319 94.5212C75.655 94.8007 76.6345 95.9026 76.784 97.3023C76.8092 97.5343 76.8137 97.769 76.828 98.0019C76.8575 98.0097 76.8863 98.0177 76.9158 98.0264ZM75.3675 97.9878C75.3326 97.7135 75.32 97.4193 75.2539 97.1363C75.0362 96.1986 74.3951 95.6899 73.4541 95.6821C72.4771 95.6732 71.7643 96.1609 71.5914 97.1029C71.4859 97.6775 71.4831 98.3033 71.5951 98.8753C71.7777 99.813 72.5183 100.322 73.4593 100.309C74.3673 100.295 75.0299 99.755 75.2466 98.8287C75.3094 98.5598 75.3263 98.2812 75.3666 97.987L75.3675 97.9878Z"
                            fill="white"/>
                        <path
                            d="M78.4336 97.9949C78.5538 97.4424 78.6061 96.8643 78.8065 96.3433C79.3325 94.9728 80.6653 94.262 82.2263 94.4448C83.784 94.6275 84.8536 95.5843 85.0723 97.0611C85.1524 97.6032 85.1819 98.175 85.1071 98.7145C84.837 100.654 83.3753 101.758 81.4442 101.539C79.567 101.326 78.506 100.051 78.4345 97.9949H78.4336ZM83.7707 97.9667C83.7021 97.5943 83.668 97.242 83.5688 96.909C83.3422 96.1491 82.7359 95.7037 81.9538 95.6792C81.0704 95.651 80.4022 96.049 80.1349 96.8178C79.8632 97.5995 79.8569 98.399 80.1539 99.1783C80.4328 99.9094 81.0921 100.32 81.9005 100.304C82.6759 100.289 83.3056 99.8513 83.5443 99.1036C83.6628 98.7329 83.7003 98.3357 83.7716 97.9659L83.7707 97.9667Z"
                            fill="white"/>
                        <path
                            d="M54.8184 99.1703C55.2331 99.116 55.6547 99.0598 56.1023 99.0009C56.1361 99.0728 56.1708 99.1335 56.1931 99.1983C56.5294 100.169 57.3969 100.571 58.3801 100.2C58.7519 100.06 59.0206 99.8034 59.0323 99.3948C59.0447 98.9712 58.7288 98.7853 58.3676 98.6818C57.7145 98.4941 57.0489 98.3442 56.4039 98.1336C55.7171 97.9091 55.2222 97.4585 55.0621 96.7383C54.8717 95.8833 55.3147 95.0431 56.1493 94.7055C57.1085 94.3179 58.0909 94.3231 59.0509 94.7037C59.8054 95.0027 60.2415 95.7035 60.2264 96.5472C60.0012 96.563 59.7707 96.5797 59.5395 96.5963C59.3205 96.6119 59.1008 96.6277 58.8934 96.6427C58.4638 95.7227 57.7269 95.4185 56.8373 95.8122C56.654 95.8937 56.436 96.1288 56.428 96.3017C56.42 96.4717 56.6219 96.7374 56.7972 96.8128C57.2279 96.9961 57.6959 97.0936 58.1496 97.2268C58.4753 97.3224 58.8089 97.3987 59.1248 97.5206C60.06 97.8801 60.4816 98.5318 60.4478 99.5237C60.4185 100.388 59.8758 101.097 58.9957 101.365C58.1407 101.625 57.2715 101.639 56.4137 101.374C55.4367 101.072 54.7757 100.159 54.8184 99.1712V99.1703Z"
                            fill="white"/>
                        <path
                            d="M44.6134 94.6333H45.8874C45.9038 94.7076 45.9324 94.7757 45.9324 94.8437C45.9186 96.3978 45.9259 97.9531 45.8767 99.5064C45.8397 100.674 45.2077 101.42 44.1124 101.535C43.4739 101.601 42.7983 101.566 42.1746 101.412C41.426 101.228 40.9227 100.621 40.8776 99.7954C40.784 98.0891 40.776 96.377 40.7324 94.6385H42.108C42.108 94.7984 42.108 94.9529 42.108 95.1065C42.108 96.4145 42.1007 97.7225 42.1104 99.0306C42.1195 100.132 42.7804 100.67 43.7935 100.422C44.2617 100.308 44.5471 100.003 44.5633 99.4355C44.6036 98.0272 44.6001 96.618 44.6134 95.2096C44.6151 95.0253 44.6134 94.8411 44.6134 94.6342V94.6333Z"
                            fill="white"/>
                        <path
                            d="M53.2995 101.35C51.5491 101.35 49.8391 101.35 48.1294 101.349C48.0622 101.349 47.9953 101.335 47.9153 101.325C47.8415 100.61 47.8525 99.9897 48.397 99.3997C49.3458 98.373 50.1968 97.2567 51.0878 96.1762C51.1838 96.0598 51.2745 95.9383 51.4147 95.7598H48.3257V94.6333H53.15C53.2172 95.2198 53.2315 95.7316 52.7823 96.2366C51.7486 97.3977 50.7862 98.6219 49.7958 99.8214C49.7085 99.9269 49.6277 100.038 49.4953 100.21H53.2995V101.349V101.35Z"
                            fill="white"/>
                        <path
                            d="M68.2468 96.5051C67.7923 96.5913 67.3624 96.6735 66.9089 96.7597C66.8636 96.6743 66.8218 96.6009 66.7854 96.5266C66.4676 95.8878 65.9998 95.6202 65.2575 95.653C64.5925 95.6824 64.027 96.0726 63.8227 96.6923C63.5636 97.4797 63.5751 98.2807 63.8281 99.0661C64.0368 99.7152 64.6005 100.094 65.2976 100.112C65.9918 100.129 66.4977 99.7991 66.7711 99.15C66.8316 99.0057 66.884 98.8581 66.9577 98.6648C67.4025 98.8055 67.8304 98.9402 68.2503 99.073C68.0061 100.568 66.6762 101.494 65.0675 101.331C63.5183 101.174 62.4289 100.152 62.2389 98.644C62.0792 97.3735 62.2239 96.1779 63.228 95.2164C64.4318 94.0622 67.4007 93.9725 68.1695 96.1875C68.2015 96.2789 68.2165 96.3747 68.2477 96.506L68.2468 96.5051Z"
                            fill="white"/>
                        <path d="M87.0996 94.6333H88.441V100.223H91.8663V101.35H87.0996V94.6333Z" fill="white"/>
                        <path
                            d="M57.3525 104.303C57.3525 105.152 57.3533 106.002 57.3516 106.851C57.3516 106.972 57.3579 107.101 57.3202 107.21C57.2977 107.275 57.1999 107.333 57.1265 107.35C57.0942 107.357 57.0342 107.253 56.9937 107.195C56.9785 107.173 56.9831 107.135 56.9831 107.105C56.9885 105.891 56.9939 104.677 57.0019 103.462C57.0019 103.438 57.0333 103.413 57.1102 103.3C57.2422 103.432 57.3839 103.539 57.4797 103.678C58.0222 104.458 58.5539 105.246 59.091 106.032C59.1725 106.151 59.2622 106.265 59.4362 106.501C59.4362 105.567 59.4227 104.771 59.445 103.976C59.4505 103.767 59.5653 103.562 59.6299 103.355C59.6853 103.555 59.785 103.752 59.7885 103.952C59.8056 104.923 59.7976 105.895 59.7947 106.867C59.7947 107.026 59.7742 107.184 59.7633 107.343C59.7096 107.367 59.6559 107.392 59.6021 107.416C58.8839 106.366 58.1665 105.315 57.4485 104.264C57.4162 104.277 57.3848 104.29 57.3525 104.303Z"
                            fill="white"/>
                        <path
                            d="M66.5176 107.413V103.517C67.2532 103.517 67.9701 103.513 68.6871 103.524C68.7586 103.525 68.8294 103.628 68.9 103.684C68.8268 103.753 68.7551 103.876 68.6793 103.879C68.2403 103.899 67.8005 103.89 67.3606 103.891C67.2081 103.891 67.0562 103.891 66.8772 103.891V105.098C67.4152 105.098 67.9231 105.086 68.4303 105.107C68.5523 105.112 68.6699 105.225 68.7902 105.289C68.6691 105.352 68.5497 105.463 68.4271 105.467C67.9207 105.487 67.4126 105.476 66.8772 105.476V107.035C67.4434 107.035 67.9794 107.025 68.5139 107.043C68.6444 107.048 68.7722 107.147 68.9009 107.204C68.7713 107.273 68.6435 107.4 68.5122 107.404C67.8618 107.425 67.2098 107.414 66.5184 107.414L66.5176 107.413Z"
                            fill="white"/>
                        <path
                            d="M72.188 103.518C72.5767 103.546 73.0053 103.672 73.2354 104.134C73.2761 104.215 73.2328 104.337 73.2285 104.441C73.1318 104.404 72.9929 104.394 72.9477 104.324C72.6714 103.9 72.2615 103.856 71.8197 103.909C71.5257 103.944 71.2158 104.065 71.2379 104.389C71.2529 104.603 71.4353 104.88 71.6249 104.992C71.9861 105.207 72.4103 105.313 72.8008 105.482C73.3151 105.705 73.5392 106.087 73.417 106.599C73.3702 106.795 73.2425 107.014 73.085 107.138C72.4385 107.642 71.3751 107.435 70.9519 106.737C70.89 106.635 70.9147 106.481 70.8986 106.352C71.0068 106.41 71.1485 106.444 71.2184 106.532C71.5939 107.005 72.1269 107.182 72.6653 106.929C72.8369 106.848 73.0354 106.633 73.0495 106.465C73.0647 106.277 72.9379 105.988 72.7804 105.893C72.4218 105.675 71.9844 105.585 71.6204 105.372C71.3458 105.212 71.0325 104.986 70.9173 104.714C70.6436 104.068 71.2265 103.51 72.188 103.517V103.518Z"
                            fill="white"/>
                        <path
                            d="M61.9661 103.517C62.2969 104.571 62.6276 105.626 62.9965 106.8C63.3224 105.631 63.6158 104.577 63.9091 103.524C63.9672 103.53 64.0246 103.535 64.0829 103.541C64.0985 103.673 64.1551 103.817 64.1243 103.936C63.8485 104.993 63.5642 106.048 63.2635 107.097C63.2277 107.222 63.0797 107.311 62.9842 107.417C62.896 107.317 62.7638 107.233 62.7274 107.116C62.3957 106.061 62.0783 105.001 61.7665 103.941C61.7325 103.824 61.7615 103.686 61.7615 103.559C61.8298 103.545 61.8978 103.531 61.9661 103.517Z"
                            fill="white"/>
                        <path
                            d="M77.0936 103.895C77.0936 104.9 77.0936 105.841 77.0936 106.782C77.0936 106.9 77.1163 107.025 77.0853 107.133C77.0554 107.238 76.9703 107.323 76.9094 107.417C76.8591 107.325 76.7709 107.238 76.7651 107.144C76.7465 106.836 76.7562 106.525 76.7562 106.216C76.7562 105.466 76.7562 104.715 76.7562 103.897C76.4522 103.897 76.1742 103.913 75.8978 103.888C75.8005 103.879 75.7104 103.774 75.6172 103.713C75.7056 103.648 75.7931 103.53 75.8824 103.528C76.5844 103.512 77.2864 103.513 77.9886 103.528C78.0655 103.529 78.1409 103.642 78.2172 103.704C78.1433 103.768 78.0729 103.881 77.9951 103.887C77.7145 103.909 77.4316 103.896 77.0918 103.896L77.0936 103.895Z"
                            fill="white"/>
                        <path
                            d="M54.5959 105.453C54.5959 105.999 54.6089 106.546 54.5849 107.09C54.5799 107.201 54.4334 107.308 54.3522 107.417C54.2911 107.309 54.1778 107.202 54.1758 107.095C54.1626 106.003 54.1626 104.912 54.1767 103.82C54.1778 103.719 54.3041 103.618 54.3723 103.517C54.4464 103.616 54.5808 103.714 54.5849 103.816C54.6059 104.361 54.5949 104.907 54.5959 105.452V105.453Z"
                            fill="white"/>
                    </svg>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExample05">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100 justify-content-evenly ">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/frontend/index">Treyding kursi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/frontend/blogs">Bloglar</a>
                        </li>
                        <li class="nav-item position-relative active">
                            <a class="nav-link" href="/frontend/books">Kitoblar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/frontend/about-us">Biz haqimizda</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="row sidebar">
        <div class="col-12">
            <div class="container">
                <main class="pt-5 text-dark">
                    <div class="row">

                        <div class="col-12 m-auto mb-5">
                            <?php $form = ActiveForm::begin([
                                'method' => 'get'
                            ]); ?>
                            <div class="row d-flex align-items-center">
                                <div class="col-5">
                                    <span class="tc1 fs-1 me-5 text-uppercase">Kitoblar</span>
                                </div>
                                <div class="col-4">
                                    <?= $form->field($searchModel, 'name')->textInput(['maxlength' => true, 'placeholder' => "Izlash"])->label('') ?>
                                </div>
                                <div class="form-group col-1">
                                    <?= Html::submitButton('Qidirish', ['class' => ' btn btn-success bg1 form-control']) ?>
                                </div>
                            </div>
                            <?php ActiveForm::end(); ?>

                        </div>

                        <?php if ($books = $dataProvider->getModels()): ?>
                            <?php
                            /**
                             * @var $book Book
                             */
                            foreach ($books as $key => $book):?>
                                <?php if ($key % 3 == 0): ?>
                                    <div class="col-12 mb-4"></div>
                                <?php endif; ?>

                                <div class="col-4">
                                    <div class="card">
                                        <div class="card-img d-flex justify-content-center">
                                            <img class="card-img-top"
                                                 src="<?= Yii::getAlias('@web') . '/img/books/' . ($book->photo ?? 'no-photo.png') ?>"
                                                 alt="">
                                        </div>
                                        <div class="card-body bg3 fs-5 text-white text-start">
                                            <p><?= $book->name ?></p>
                                            <p><?= $book->description ?></p>
                                            <span class="d-flex justify-content-between">
                                                <?php if ($book->price): ?>
                                                    <span class=""><?= pul2($book->price, 2) . ' so\'m' ?></span>
                                                    <form method="post" action="<?= \yii\helpers\Url::to(['order/buy']) ?>">
                                                      <input type="hidden" name="wants" value="book"/>
                                                      <input type="hidden" name="id" value="<?= $book->uuid ?>"/>
                                                      <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>"/>
                                                      <button class="btn text-white btn btn-success fs-5" type="submit">Sotib olish</button>
                                                    </form>
                                                <?php else: ?>
                                                    <span style="color: #05C979">Bepul</span>
                                                    <form method="post" action="<?= \yii\helpers\Url::to(['book/download']) ?>">
                                                      <input type="hidden" name="id" value="<?= $book->uuid ?>"/>
                                                      <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>"/>
                                                      <button class="btn text-white btn btn-success fs-5" type="submit">Yuklab olish</button>
                                                    </form>
                                                <?php endif; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                            <?= LinkPager::widget([
                                'options' => [
                                    'class' => 'd-flex justify-content-center mt-5',
                                ],
                                'pagination' => $dataProvider->pagination,
                            ]); ?>
                        <?php endif; ?>

                        <div class="col-12 text-center">
                            <div class="d-flex justify-content-center my-5">
                                <form method="post" action="<?= \yii\helpers\Url::to(['order/buy']) ?>">
                                    <input type="hidden" name="wants" value="course"/>
                                    <input type="hidden" name="id" value="c41d9932-6fdf-4121-b278-01d65e516eb3"/>
                                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>"/>
                                    <button class="btn btn-success my-3 rounded rounded-pill fs-3 px-4" type="submit">Kursni sotib olish</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div class="row">
                <div class="col-12 text-center py-5 bg7">
                    <h1>Biz bilan birga rivojlaning</h1>
                    <h1 class="trade fs-1">Uzscool invest!</h1>
                </div>
            </div>

        </div>

    </div>

</div>

<script src="<?= Yii::getAlias('@web') ?>/front/assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
