<style>
    .loader_div p{
        position:absolute;
        top: 60%;
        left: 50%;
        transform: translate(-60%, -50%);
        font-weight: bold;
        font-size: 1.2em;
    }
    .loader {
        position: absolute;
        left: 50%;
        top: 50%;
        z-index: 1;
        width: 150px;
        height: 150px;
        margin: -75px 0 0 -75px;
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
    }

  @-webkit-keyframes spin {
      0% { -webkit-transform: rotate(0deg); }
      100% { -webkit-transform: rotate(360deg); }
  }

  @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
  }
</style>

<div class="loader_div" style="display: none;">
    <p>로딩중...</p>
    <div class="loader">
    </div>
</div>