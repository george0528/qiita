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
      history_contents.push(item);
      this.setHistory(history_contents);
    }
  }
}