<template>
  <div>
    <p><span>{{ typingText }}</span><span data-testid="temp-file" class="cursor">)</span></p>
  </div>
</template>

<script>
export default {
  props: ['head'],
  data() {
    return {
      greeting: 'Hi User',
      text: this.head,
      typingText: '',
      typingSpeed: 150, // Typing speed in milliseconds
      holdDuration: 1000, // Hold duration in milliseconds
      deleteSpeed: 50,  // Deleting speed in milliseconds
      isDeleting: false
    };
  },
  mounted() {
    this.typeDeleteLoop();
  },
  methods: {
    typeDeleteLoop() {
      setTimeout(() => {
        this.isDeleting = true;
        setTimeout(() => {
          this.isDeleting = false;
          this.typingText = '';
          setTimeout(() => {
            this.typeText();
          }, this.typingSpeed);
        }, this.holdDuration);
      }, this.typingSpeed);
    },
    typeText() {
      let index = 0;
      const typingInterval = setInterval(() => {
        if (!this.isDeleting) {
          if (index < this.text.length) {
            this.typingText += this.text[index];
            index++;
          } else {
            clearInterval(typingInterval);
          }
        } else {
          if (this.typingText.length > 0) {
            this.typingText = this.typingText.slice(0, -1);
          } else {
            clearInterval(typingInterval);
          }
        }
      }, this.isDeleting ? this.deleteSpeed : this.typingSpeed);
    }
  }
};
</script>

<style scoped>
.cursor {
  display: inline-block;
  animation: blink-caret 0.75s infinite;
}

@keyframes blink-caret {
  from, to {
    opacity: 0;
  }
  50% {
    opacity: 1;
  }
}
</style>
