export default {
  methods: {
    getHistory() {
      return JSON.parse(localStorage.getItem('history'));
    },
    // 履歴をシリアライズして保存
    setHistory(contents) {
      contents = JSON.stringify(contents);
      localStorage.setItem('history', contents);
    },
    addHistory(item) {
      let history_contents = this.getHistory();

      if(history_contents == null) {
        this.setHistory([item]);
        return;
      }

      // 上限を超えていたら削除
      while(history_contents.length > 50) {
        history_contents.shift();
      }

      history_contents.push(item);
      this.setHistory(history_contents);
    },
    getPathColor(path) {
      let color = '';
      switch (path) {
        case '/':
          color = '#607D8B';
          break;
        case '/save-contents':
          color = 'success';
          break;
        case '/history':
          color = '#795548';
          break;
        default:
          color = 'default';
          break;
      }
      return color;
    }
  }
}