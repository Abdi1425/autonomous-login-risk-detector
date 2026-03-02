<?php
class RiskEngine {
    public function evaluate($data) {
        $attempts = $data['attempts'];
        $hour = $data['hour'];
        $location = $data['location'];

        // Risk calculation
        $riskScore = ($attempts * 0.3) +
                     (($hour < 6 || $hour > 22) ? 0.3 : 0.1) +
                     ($location * 0.4);

        if ($riskScore > 0.7) {
            $decision = "BLOCK";
        } elseif ($riskScore > 0.4) {
            $decision = "REQUIRE 2FA";
        } else {
            $decision = "ALLOW";
        }

        return [
            "decision" => $decision,
            "score" => round($riskScore,2)
        ];
    }
}
?>