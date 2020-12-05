<?php

class day4 extends DayInALife
{
    public function getResultPartOne()
    {
        $passports = $this->loadPassports();

        $validPassport = 0;
        foreach ($passports as $passport) {
            if ($this->isPassportValid($passport)) {
                $validPassport++;
            }
        }

        return $validPassport;
    }

    public function getResultPartTwo()
    {
        $passports = $this->loadPassports();

        $validPassport = 0;
        foreach ($passports as $passport) {
            if ($this->isPassportReallyValid($passport)) {
                $validPassport++;
            }
        }

        return $validPassport;
    }

    private function loadPassports(): array
    {
        return explode(PHP_EOL.PHP_EOL, $this->fileContent);
    }

    private function isPassportValid(string $passport): bool
    {
        return (
            strpos($passport, 'byr:') !== false &&
            strpos($passport, 'iyr:') !== false &&
            strpos($passport, 'eyr:') !== false &&
            strpos($passport, 'hgt:') !== false &&
            strpos($passport, 'hcl:') !== false &&
            strpos($passport, 'ecl:') !== false &&
            strpos($passport, 'pid:') !== false
        );
    }

    private function isPassportReallyValid(string $passport): bool
    {
        if (!$this->isPassportValid($passport)) {
            return false;
        }

        $data = $this->extractPassportData($passport);

        if (!$this->isBirthYearValid($data['byr'])) return false;
        if (!$this->isIssueYearValid($data['iyr'])) return false;
        if (!$this->isExpirationYearValid($data['eyr'])) return false;
        if (!$this->isHeightValid($data['hgt'])) return false;
        if (!$this->isHairColorValid($data['hcl'])) return false;
        if (!$this->isEyeColorValid($data['ecl'])) return false;
        if (!$this->isPassportIdValid($data['pid'])) return false;

        return true;
    }

    private function extractPassportData(string $passport): array
    {
        $passport = trim($passport);
        $data = preg_split('/[\s]+/', $passport);

        foreach ($data as $rawField) {
            $field = explode(':', $rawField);
            $data[$field[0]] = $field[1];
        }

        return $data;
    }

    private function isBirthYearValid($byr): bool
    {
        return (int) $byr >= 1920 && (int) $byr <= 2002;
    }

    private function isIssueYearValid($iyr): bool
    {
        return (int) $iyr >= 2010 && (int) $iyr <= 2020;
    }

    private function isExpirationYearValid($eyr): bool
    {
        return (int) $eyr >= 2020 && (int) $eyr <= 2030;
    }

    private function isHeightValid($hgt): bool
    {
        if (strpos($hgt, 'cm')) {
            $height = preg_replace('/\D/', '', $hgt);
            return $height >= 150 && $height <= 193;
        }

        if (strpos($hgt, 'in')) {
            $height = preg_replace('/\D/', '', $hgt);
            return $height >= 59 && $height <= 76;
        }

        return false;
    }

    private function isHairColorValid($hcl): bool
    {
        return preg_match('/#[0-9a-fA-F]{6}/', $hcl);
    }

    private function isEyeColorValid($ecl): bool
    {
        return (
            $ecl === 'amb' ||
            $ecl === 'blu' ||
            $ecl === 'brn' ||
            $ecl === 'gry' ||
            $ecl === 'grn' ||
            $ecl === 'hzl' ||
            $ecl === 'oth'
        );
    }

    private function isPassportIdValid($pid): bool
    {
        return ctype_digit($pid) && strlen($pid) === 9;
    }
}
