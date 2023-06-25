<style>
  :root{
    --size: 60px;
    /* --order: 2; */
  }
  
  .loader-11 {
    width: var(--size);
    height: var(--size);
    border-radius: 50%;
    display: inline-block;
    position: relative;
    border: 3px solid;
    border-color: var(--secondary-color) var(--secondary-color) transparent transparent;
    animation: rotation 1s linear infinite;
  }

  .loader-11:after,
  .loader-11:before {
    content: "";
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    margin: auto;
    border: 3px solid;
    border-color: transparent transparent var(--primary-color) var(--primary-color);
    width: var(--size) - 8px;
    height: var(--size) - 8px;
    border-radius: 50%;
    animation: rotationBack 0.5s linear infinite;
    transform-origin: center center;
  }

  .loader-11:before {
    width: var(--size) - 16px;
    height: var(--size) - 16px;
    border-color: var(--secondary-color) var(--secondary-color) transparent transparent;
    animation: rotation 1.5s linear infinite;
  }

  @keyframes rotation {
    0% {
      transform: rotate(0deg);
    }
    100% {
      transform: rotate(360deg);
    }
  }

  @keyframes rotationBack {
    0% {
      transform: rotate(0deg);
    }
    100% {
      transform: rotate(-360deg);
    }
  }
</style>