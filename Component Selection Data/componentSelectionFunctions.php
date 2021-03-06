<?php

    // Retrieves hardware information from PCParts DB
    function getCases($dbConn) {
        // Create sql statement
        $sql = "SELECT `Case`.*, MBFormFactors.*
                FROM `Case`
                LEFT JOIN MBFormFactors
                    ON `Case`.caseFFId=MBFormFactors.mbFFId
                ORDER BY `Case`.caseName";
        
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        
        $componentArr = [];
        $component = [];
        $i = 0;
        
        while($row = $stmt->fetch()) {
            $component["caseId"] = $row["caseId"];
            $component["caseName"] = $row["caseName"];
            $component["caseFFType"] = $row["mbFFType"];
            $component["maxGPULengthInches"] = $row["maxGPULengthInches"];
            $component["caseNum25Bays"] = $row["caseNum25Bays"];
            $component["caseNum35Bays"] = $row["caseNum35Bays"];
            $component["casePrice"] = $row["casePrice"];
            $componentArr[$i] = $component;
            $i++;
        }
        
        return $componentArr;
    }
    
    // Retrieves hardware information from PCParts DB
    function getCase($dbConn,$id) {
        // Create sql statement
        $sql = "SELECT `Case`.*, MBFormFactors.*
                FROM `Case`
                LEFT JOIN MBFormFactors
                    ON `Case`.caseFFId=MBFormFactors.mbFFId
                WHERE `Case`.caseId=$id";
        
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        
        $row = $stmt->fetch();
        
        return $row;
    }
    
    function getCPUs($dbConn) {
             // Create sql statement
            $sql = "SELECT CPU.*, Socket.*
                    FROM CPU 
                    LEFT JOIN Socket
                        ON CPU.cpuSocketId=Socket.socketId
                    ORDER BY CPU.cpuName";
            
            // Prepare SQL
            $stmt = $dbConn->prepare($sql);
            
            // Execute SQL
            $stmt->execute();
            
            $componentArr = [];
            $component = [];
            $i = 0;
            
            while($row = $stmt->fetch()) { 
                $component["cpuId"] = $row["cpuId"];
                $component["cpuName"] = $row["cpuName"];
                $component["cpuBaseClock"] = $row["cpuBaseClock"];
                $component["socketType"] = $row["socketType"];
                $component["cpuNumCores"] = $row["cpuNumCores"];
                $component["cpuTDP"] = $row["cpuTDP"];
                $component["cpuPrice"] = $row["cpuPrice"];
                $componentArr[$i] = $component;
                $i++;
            }
            
            return $componentArr;
        }
        
        function getCPU($dbConn, $id) {
             // Create sql statement
            $sql = "SELECT CPU.*, Socket.*
                    FROM CPU 
                    LEFT JOIN Socket
                        ON CPU.cpuSocketId=Socket.socketId
                    WHERE CPU.cpuId=$id";
            
            // Prepare SQL
            $stmt = $dbConn->prepare($sql);
            
            // Execute SQL
            $stmt->execute();
            $row = $stmt->fetch();
            
            return $row;
        }
        
    function getGPUs($dbConn) {
        // Create sql statement
        $sql = "SELECT GPU.*
                FROM GPU ORDER BY gpuName";
        
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        
        $componentArr = [];
        $component = [];
        $i = 0;
        
        while($row = $stmt->fetch()) { 
            $component["gpuId"] = $row["gpuId"];
            $component["gpuName"] = $row["gpuName"];
            $component["gpuManufacturer"] = $row["gpuManufacturer"];
            $component["gpuBaseClock"] = $row["gpuBaseClock"];
            $component["gpuMemSize"] = $row["gpuMemSize"];
            $component["gpuLengthInches"] = $row["gpuLengthInches"];
            $component["gpuTDP"] = $row["gpuTDP"];
            $component["gpuPrice"] = $row["gpuPrice"];
            $componentArr[$i] = $component;
            $i++;
        }
        
        return $componentArr;
    }
    
    function getGPU($dbConn, $id) {
        // Create sql statement
        $sql = "SELECT GPU.*
                FROM GPU 
                WHERE GPU.gpuId=$id";
        
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        
        $row = $stmt->fetch();
        
        return $row;
    }
    
    function getMotherboards($dbConn) {
         // Create sql statement
        $sql = "SELECT Motherboard.*, Socket.*, MBFormFactors.*, RamType.* 
                FROM Motherboard
                LEFT JOIN Socket
                    ON Motherboard.mbSocketId=Socket.socketId
                LEFT JOIN MBFormFactors
                    ON Motherboard.mbFFId=MBFormFactors.mbFFId
                LEFT JOIN RamType
                    ON Motherboard.mbRamTypeId=RamType.ramTypeId";
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        
        $componentArr = [];
        $component = [];
        $i = 0;

        while($row = $stmt->fetch()) { 
            $component["mbId"] = $row["mbId"];
            $component["mbName"] = $row["mbName"];
            $component["socketType"] = $row["socketType"];
            $component["mbFFType"] = $row["mbFFType"];
            $component["mbNumRamSlots"] = $row["mbNumRamSlots"];
            $component["ramType"] = $row["ramType"];
            $component["mbPrice"] = $row["mbPrice"];
            $componentArr[$i] = $component;
            $i++;
        }
        return $componentArr;
    }
    
    function getMotherboard($dbConn, $id) {
         // Create sql statement
        $sql = "SELECT Motherboard.*, Socket.*, MBFormFactors.*, RamType.* 
                FROM Motherboard
                LEFT JOIN Socket
                    ON Motherboard.mbSocketId=Socket.socketId
                LEFT JOIN MBFormFactors
                    ON Motherboard.mbFFId=MBFormFactors.mbFFId
                LEFT JOIN RamType
                    ON Motherboard.mbRamTypeId=RamType.ramTypeId
                WHERE Motherboard.mbId=$id";
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();

        $row = $stmt->fetch();
        
        return $row;
    }
    
    function getMBFormFactors($dbConn) {
         // Create sql statement
        $sql = "SELECT MBFormFactors.* 
                FROM MBFormFactors
                ORDER BY MBFormFactors.mbFFId";
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        
        $componentArr = [];
        $component = [];
        $i = 0;

        while($row = $stmt->fetch()) { 
            $component["mbFFId"] = $row["mbFFId"];
            $component["mbFFType"] = $row["mbFFType"];
            $componentArr[$i] = $component;
            $i++;
        }
        return $componentArr;
    }
    
    function getPSUs($dbConn) {
        // Create sql statement
        $sql = "SELECT psuId, psuName, psuWatts, psuModularity, psuPrice, psuEfficiency
                FROM PSU ORDER BY psuName";
        
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        
        $componentArr = [];
        $component = [];
        $i = 0;
        
        while($row = $stmt->fetch()) { 
            $component["psuId"] = $row["psuId"];
            $component["psuName"] = $row["psuName"];
            $component["psuWatts"] = $row["psuWatts"];
            $component["psuEfficiency"] = $row["psuEfficiency"];
            $component["psuModularity"] = $row["psuModularity"];
            $component["psuPrice"] = $row["psuPrice"];
            $componentArr[$i] = $component;
            $i++;
        }
        
        return $componentArr;
    }
    
    function getPSU($dbConn, $id) {
        // Create sql statement
        $sql = "SELECT psuId, psuName, psuWatts, psuModularity, psuPrice, psuEfficiency
                FROM PSU WHERE PSU.psuID=$id";
        
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        
        $row = $stmt->fetch();
        
        return $row;
    }
    
    function getRam($dbConn) {
         // Create sql statement
        $sql = "SELECT RAM.*, RamType.*
                FROM RAM 
                LEFT JOIN RamType
                    ON RAM.ramTypeId=RamType.ramTypeId
                ORDER BY RAM.ramName";
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        
        $componentArr = [];
        $component = [];
        $i = 0;
        
        while($row = $stmt->fetch()) { 
            $component["ramId"] = $row["ramId"];
            $component["ramName"] = $row["ramName"];
            $component["ramType"] = $row["ramType"];
            $component["ramSizeGB"] = $row["ramSizeGB"];
            $component["ramSpeed"] = $row["ramSpeed"];
            $component["ramCas"] = $row["ramCas"];
            $component["ramPrice"] = $row["ramPrice"];
            $componentArr[$i] = $component;
            $i++;
        }
        
        return $componentArr;
    }
    
    function getRamSingle($dbConn,$id) {
         // Create sql statement
        $sql = "SELECT RAM.*, RamType.*
                FROM RAM 
                LEFT JOIN RamType
                    ON RAM.ramTypeId=RamType.ramTypeId
               WHERE RAM.ramId=$id";
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        
        $row = $stmt->fetch();
        
        return $row;
    }
    
    function getRamTypes($dbConn) {
        // Create sql statement
        $sql = "SELECT RamType.*
                FROM RamType";
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        
        $componentArr = [];
        $component = [];
        $i = 0;
        
        while($row = $stmt->fetch()) { 
            $componentArr[$i] = $row;
            $i++;
        }
        
        return $componentArr;
    }
    
    function getSockets($dbConn) {
        // Create sql statement
        $sql = "SELECT Socket.*
                FROM Socket
                ORDER BY Socket.socketId";
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        
        $componentArr = [];
        $component = [];
        $i = 0;
        
        while($row = $stmt->fetch()) { 
            $component["socketId"] = $row["socketId"];
            $component["socketType"] = $row["socketType"];
            $componentArr[$i] = $component;
            $i++;
        }
        
        return $componentArr;
    }
    
    function getStorages($dbConn) {
        // Create sql statement
        $sql = "SELECT Storage.*, StorageFormFactors.*
                FROM Storage 
                LEFT JOIN StorageFormFactors
                    ON Storage.storageFFId=StorageFormFactors.storageFFId
                ORDER BY Storage.storageName";
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        
        $componentArr = [];
        $component = [];
        $i = 0;
        
        while($row = $stmt->fetch()) { 
            $component["storageId"] = $row["storageId"];
            $component["storageName"] = $row["storageName"];
            $component["storageSize"] = $row["storageSize"];
            $component["storageType"] = $row["storageType"];
            $component["storageRPM"] = $row["storageRPM"];
            $component["storageFFType"] = $row["storageFFType"];
            $component["storagePrice"] = $row["storagePrice"];
            $componentArr[$i] = $component;
            $i++;
        }
        
        return $componentArr;
    }
    
    function getStorage($dbConn, $id) {
        // Create sql statement
        $sql = "SELECT Storage.*, StorageFormFactors.*
                FROM Storage 
                LEFT JOIN StorageFormFactors
                    ON Storage.storageFFId=StorageFormFactors.storageFFId
                WHERE Storage.storageId=$id";
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        
        $row = $stmt->fetch();
        
        return $row;
    }
    
    function getStorageFormFactors($dbConn) {
        // Create sql statement
        $sql = "SELECT StorageFormFactors.*
                FROM StorageFormFactors";
        
        // Prepare SQL
        $stmt = $dbConn->prepare($sql);
        
        // Execute SQL
        $stmt->execute();
        
        $componentArr = [];
        $component = [];
        $i = 0;
        
        while($row = $stmt->fetch()) { 
            $component["storageFFId"] = $row["storageFFId"];
            $component["storageFFType"] = $row["storageFFType"];
            $componentArr[$i] = $component;
            $i++;
        }
        
        return $componentArr;
    }

?>