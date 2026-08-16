import EventEmitter from "./EventEmitter";

export default class Time extends EventEmitter {
    constructor() {
        super();

        // Setup
        this.start = Date.now();
        this.current = this.start;
        this.elapsed = 0;
        this.delta = 16;

        // Upper bound for a single frame delta (ms). A main-thread stall (GC,
        // heavy layout, window drag) would otherwise report one huge delta, and
        // consumers that scale an effect by `delta` would jump through it in a
        // single frame. Resuming from a pause is handled separately, by
        // re-anchoring in `play()`.
        this.maxDelta = 100;

        this.running = false;
        this.frameId = null;

        this.tick = this.tick.bind(this);

        this.play();
    }

    // Start (or resume) the loop. Safe to call when already running.
    play() {
        if (this.running) return;

        this.running = true;
        // Re-anchor on resume so the next delta measures one frame, not the pause.
        this.current = Date.now();
        this.frameId = window.requestAnimationFrame(this.tick);
    }

    // Stop the loop entirely: no rAF is queued while paused, so consumers do no
    // work at all. Safe to call when already paused.
    pause() {
        if (!this.running) return;

        this.running = false;

        if (this.frameId !== null) {
            window.cancelAnimationFrame(this.frameId);
            this.frameId = null;
        }
    }

    tick() {
        const currentTime = Date.now();

        this.delta = Math.min(currentTime - this.current, this.maxDelta);
        this.current = currentTime;
        // Accumulate rather than diffing against `start`, so paused time does not
        // count and animations driven by `elapsed` resume where they left off.
        this.elapsed += this.delta;

        this.trigger('tick')

        if (this.running) {
            this.frameId = window.requestAnimationFrame(this.tick);
        }
    }
}
