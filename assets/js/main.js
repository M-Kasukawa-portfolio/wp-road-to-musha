const modal = () => {
  const modal = document.querySelector(".js-search-modal");
  const modalBg = document.querySelector(".js-modal-bg");
  const modalContents = document.querySelector(".js-search-modal-contents");
  const button = document.querySelector(".js-search-modal-open");
  const closeButton = document.querySelector(".js-search-modal-close");

  // コンテンツ Opening Keyframe
  const contentsOpeningKeyframes = {
    opacity: [0, 1],
    transform: ["scale(0.98)", "scale(1)"],
  };

  // 背景 Opening Keyframe
  const bgOpeningKeyframes = {
    opacity: [0, 1],
  };

  // コンテンツ Opening Option
  const contentsOpeningOptions = {
    duration: 300,
    easing: "ease-out",
    fill: "forwards",
  };

  // 背景 Opening Option
  const bgOpeningOptions = {
    duration: 150,
    easing: "ease-out",
    fill: "forwards",
  };

  // コンテンツ Closing Keyframe
  const contentsClosingKeyframes = {
    opacity: [1, 0],
    transform: ["scale(1)", "scale(0.98)"],
  };

  // 背景 Closing Keyframe
  const bgClosingKeyframes = {
    opacity: [1, 0],
  };

  // コンテンツ Closing Option
  const contentsClosingOptions = {
    duration: 300,
    easing: "ease-out",
    fill: "forwards",
  };

  // 背景 Closing Option
  const bgClosingOptions = {
    duration: 150,
    easing: "ease-out",
    fill: "forwards",
  };

  // modalとbuttonがページ内にない場合returnする
  if (!modal || !button) return;

  // モーダルopenする関数
  const openModal = () => {
    modal.showModal();
    modalContents.animate(contentsOpeningKeyframes, contentsOpeningOptions);
    modalBg.style.display = "block";
    modalBg.animate(bgOpeningKeyframes, bgOpeningOptions);
  };

  // モーダルcloseする関数
  const closeModal = () => {
    const closingAnim = modalContents.animate(contentsClosingKeyframes, contentsClosingOptions);
    modalBg.animate(bgClosingKeyframes, bgClosingOptions);

    // アニメーションの完了後
    closingAnim.onfinish = () => {
      modal.close();
      modalBg.style.display = "none";
    };
  };

  // ボタンクリックでモーダルopen
  button.addEventListener("click", () => {
    openModal();
  });

  // クローズボタンクリックでモーダルclose
  closeButton.addEventListener("click", () => {
    closeModal();
  });

  // 検索フォーム送信時にモーダルを閉じる処理を追加
  const searchForm = document.querySelector(".search-modal-contents-inner");
  if (searchForm) {
    searchForm.addEventListener("submit", () => {
      closeModal();
    });
  }

  // 背景クリックでモーダルclose
  modal.addEventListener("click", (event) => {
    if (event.target.closest(".js-search-modal-contents") === null) {
      closeModal();
    }
  });

  // Escapeキーを押すと非表示
  document.addEventListener("keydown", function (event) {
    if (event.key === "Escape") {
      event.preventDefault();
      closeModal();
    }
  });
};

modal();
